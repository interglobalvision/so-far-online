import shippingCountries from './shipping-countries'

class Shop {
  constructor() {
    this.onReady = this.onReady.bind(this)
    this.handleAddToCart = this.handleAddToCart.bind(this)
    
    this.state = {
      cart: [],
      cartData: null,
      rate: 1,
      rateData: null,
      currency: 'SGD'
    }

    $(this.onReady)
  }

  onReady() {
    const params = new URLSearchParams(window.location.search)
    const checkout = params.get('checkout')

    if (checkout && checkout === 'success') {
      const ids = params.get('ids')
      const nonce = params.get('nonce')
      this.handleCheckoutSuccess(ids, nonce)
    } else {
      this.loadCart()
    }
    
    if ($('body').hasClass('page-bag')) {
      this.loadCurrency()
      this.setupCart()
    } else if ($('.product').length) {
      this.setupProducts()
    }
  }

  loadCart() {
    const savedCart = localStorage.getItem('cart')
    if (savedCart) {
      this.state.cart = JSON.parse(savedCart).sort((a,b) => a.createdAt - b.createdAt)
      this.updateCartCount()
    } else {
      this.saveCart()
    }
  }

  saveCart() {
    localStorage.setItem('cart', JSON.stringify(this.state.cart)) 
    this.updateCartCount()
  }

  loadCurrency() {
    const savedCurrency = localStorage.getItem('currency')
    if (savedCurrency) {
      this.state.currency = savedCurrency
    } else {
      this.saveCurrency('SGD')
    }
  }

  saveCurrency(code) {
    this.state.currency = code
    localStorage.setItem('currency', code) 
    this.updateCurrency()
  }

  setupProducts() {
    let _this = this
    $('.product').each(function() {
      const postId = $(this).data('postId')
      _this.setInCartAttr($(this))
    })
    this.setupAddToCart()
  }

  setupAddToCart() {
    let _this = this
    $('.add-to-cart').each(function() {
      const postId = $(this).data('postId')
      const $product = $(this).closest('.product')

      $(this).on('click', function() {
        const price = $(this).data('price')
        _this.handleAddToCart(postId, price)
        _this.setInCartAttr($product)
      })
    })
  }

  handleAddToCart(postId, price) {
    const cartItem = {
      createdAt: Date.now(),
      postId,
      qty: 1
    }
    this.state.cart.push(cartItem)
    this.saveCart()
  }

  setInCartAttr($product) {
    const postId = $product.data('postId')
    const productInCart = this.state.cart.find(i => i.postId === postId)
    if (productInCart) {
      $product.attr('data-in-cart', 'true')
    } else {
      $product.attr('data-in-cart', 'false')
    }
  }

  handleRemoveFromCart(postId) {
    this.state.cart = this.state.cart.filter(p => p.postId !== postId)
    if (this.state.cart.length === 0) { this.showEmptyCart() }
    this.saveCart()
    this.updateSubtotal()
  }

  updateCartCount() {
    const count = this.state.cart.length > 0 ? this.state.cart.length.toString() : ''
    $('.cart-count').html(count)
  }

  setupCart() {
    this.$cart = $('#cart')
    if (this.state.cart.length > 0) {
      this.displayCartItems()
      this.bindCurrencyChange()
      this.updateCurrency()
      this.bindCheckout()
    } else {
      this.showEmptyCart()
    }
  }

  showEmptyCart() {
    this.$cart.attr('data-cart-empty', 'true');
  }

  getCartData() {
    const cartIds = this.state.cart.map(p => p.postId)
    const fields = 'id,title,link,cmb2,featured_media,excerpt,_embedded'
    return $.get(WP.siteUrl + '/wp-json/wp/v2/product?include=' + cartIds.toString() + '&_embed=wp:featuredmedia')
  }

  async displayCartItems() {
    let _this = this
    const $items = $('.cart-item')
    const $container = $('#cart-items')
    const itemHtml = $items[0].outerHTML
    this.state.cartData = await this.getCartData()

    $container.html('');
    
    this.state.cart.forEach((p, i) => {
      const $item = $(itemHtml);
      $container.append($item);

      const data = _this.state.cartData.find(d => d.id === p.postId)
      const id = data.id
      const meta = data.cmb2._igv_artwork_metabox
      const title = data.title.rendered
      const link = data.link
      const imageSrc = data._embedded["wp:featuredmedia"][0].media_details.sizes.medium.source_url
      const price = meta._igv_product_price

      $item.find('.cart-title')
        .text(title)
        .attr('href', link)
      
      $item.find('.cart-thumb')
        .css('background-image', 'url(\'' + imageSrc + '\')')
        .attr('href', link)

      $item.find('.cart-quantity').val(p.qty)

      $item.find('.cart-item-subtotal').text(price)

      this.bindRemoveItem($item, id)
      this.bindQuantityChange($item, id)
    })

    this.$cart.attr('data-cart-empty', 'false');

    this.updateCurrency()
  }

  bindRemoveItem($item, id) {
    let _this = this
    $item.find('.cart-remove')
      .on('click', function() {
        _this.handleRemoveFromCart(id)
        $item.remove()
      })
  }

  bindQuantityChange($item, id) {
    const _this = this
    const data = this.state.cartData.find(d => d.id === id)
    const inventory = data.cmb2._igv_artwork_metabox._igv_product_inventory
    $item.find('.cart-quantity')
      .attr('max', inventory)
      .on('change', function() {
        const val = $(this).val()
        let qty = parseInt($(this).val())

        if (qty < 1) {
          qty = 1
          $(this).val(qty)
        } else if (qty > inventory) {
          qty = inventory 
          $(this).val(qty)
        }

        _this.state.cart = _this.state.cart.map(p => {
          if (p.postId === id) {
            const updated = p
            updated.qty = qty
            return updated
          }
          return p
        })
        _this.saveCart()
        _this.updateSubtotal()
      })
  }

  updateCurrency() {
    let _this = this
    if (this.state.rateData === null) {
      this.getCurrencyRates()
    } else {
      this.updateSubtotal()
    }
  }

  updateSubtotal() {
    if (this.state.currency && this.state.cartData) {
      this.subtotal = this.getSubtotal()
      $('#cart-subtotal').text(this.subtotal)
    }
  }

  getSubtotal() {
    this.state.rate = this.state.rateData[this.state.currency]
    const subtotal = this.state.cart.reduce((v, p) => {
      const data = this.state.cartData.find(d => d.id === p.postId)
      const price = data.cmb2._igv_artwork_metabox._igv_product_price
      const qty = p.qty
      return (price * this.state.rate * qty) + v
    }, 0)
    return subtotal.toFixed(2)
  }

  async getCurrencyRates() {
    $('#cart-currency-select').val(this.state.currency)
    const apikey = 'f8fdffe0-4a32-11ec-8ad0-23ccb29ede4e'
    const endpoint = 'https://freecurrencyapi.net/api/v2/latest?apikey=' + apikey + '&base_currency=SGD'
    const response = await $.get(endpoint)
    this.state.rateData = response.data
    this.updateCurrency()
  }

  bindCurrencyChange() {
    let _this = this
    $('#cart-currency-select').on('change', function() {
      _this.saveCurrency($(this).val())
    })
  }

  bindCheckout() {
    let _this = this
    $('.cart-checkout').on('click', function(e) {
      e.preventDefault()
      _this.createCheckout($(this).data('checkoutNonce'))
    })
  }

  getUnitAmount(price) {
    const amount = this.state.rate * price
    return parseFloat(amount.toFixed(2)) * 100
  }

  assembleLineItems() {
    const lineItems = this.state.cart.map(p => {
      const data = this.state.cartData.find(d => d.id === p.postId)
      
      const unitAmount = this.getUnitAmount(data.cmb2._igv_artwork_metabox._igv_product_price)
      const title = data.title.rendered
      const image = data._embedded["wp:featuredmedia"][0].media_details.sizes.thumbnail.source_url
      
      const priceData = {
        currency: this.state.currency.toLowerCase(),
        product_data: {
          name: title,
          images: [ image ]
        },
        unit_amount_decimal: unitAmount
      }
      
      return {
        price_data: priceData,
        quantity: p.qty
      }
    })

    return JSON.stringify(lineItems)
  }

  getShippingAmount(territory) {
    const weight = this.state.cartData.reduce((v, d) => {
      const w = d.cmb2._igv_artwork_metabox._igv_product_weight ? d.cmb2._igv_artwork_metabox._igv_product_weight : 0
      return v + parseFloat(w)
    }, 0)
    let amount = 0
    const options = WP.shippingOptions[territory]
    if (options && options.length > 0) {
      for (let o of options) {
        if (!o.max || o.max > weight) {
          amount = this.getUnitAmount(o.cost) 
          break
        }
      }
    }
    return amount
  }

  assembleShippingOptions() {
    const shippingOptions = [
      {
        shipping_rate_data: {
          type: 'fixed_amount',
          fixed_amount: {
            amount: this.getShippingAmount('domestic'),
            currency: this.state.currency.toLowerCase(),
          },
          display_name: WP.shippingDomesticLabel,
        }
      },
      {
        shipping_rate_data: {
          type: 'fixed_amount',
          fixed_amount: {
            amount: this.getShippingAmount('international'),
            currency: this.state.currency.toLowerCase(),
          },
          display_name: WP.shippingInternationalLabel,
        }
      }
    ]
    return JSON.stringify(shippingOptions)
  }

  createCheckout(nonce) {
    const lineItems = this.assembleLineItems()
    const shippingOptions = this.assembleShippingOptions()
    const ids = this.state.cart.map(p => p.postId).toString()
    const framing = $('#cart-framing').prop('checked') 
    const metadata = JSON.stringify({
      framing: framing.toString()
    })
    const shippingAddress = JSON.stringify({
      allowed_countries: shippingCountries
    })

    $.post(WP.siteUrl + '/wp-json/endpoint/v1/createCheckout', {
      success_url: WP.siteUrl + '?checkout=success&ids=' + ids + '&nonce=' + nonce,
      cancel_url: WP.siteUrl + '/bag',
      line_items: lineItems,
      metadata: metadata,
      shipping_address_collection: shippingAddress,
      shipping_options: shippingOptions
    }, function(data){
      const res = JSON.parse(data)
      console.log(res)
      
      if (res.success === 'true') {
        window.location.href = res.data.url
      } else {
        alert('There was an error creating your checkout. Please try again, or contact us for assistance.')
      }
    })
  }

  handleCheckoutSuccess(ids, nonce) {
    this.state.cart = []
    this.saveCart()
    window.history.replaceState({}, document.title, '/');
    $.post(WP.siteUrl + '/wp-json/endpoint/v1/checkoutSuccess', {
      'ids': ids,
      'nonce': nonce
    }, function(data){
      const res = JSON.parse(data)
      console.log(res)
    })
  }

  getAllProducts(ids) {
    $.post(WP.siteUrl + '/wp-json/endpoint/v1/getAllProducts', {
      'ids': ids
    }, function(data){
      const res = JSON.parse(data)
      console.log(res)
    })
  }

  getProduct(id) {
    $.post(WP.siteUrl + '/wp-json/endpoint/v1/getProduct', {
      'id': id
    }, function(data){
      const res = JSON.parse(data)
      console.log(res)
    })
  }

  getPrice(id) {
    $.post(WP.siteUrl + '/wp-json/endpoint/v1/getPrice', {
      'id': id
    }, function(data){
      const res = JSON.parse(data)
      console.log(res)
    })
  }
}

export default Shop