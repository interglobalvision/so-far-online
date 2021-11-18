class Shop {
  constructor() {
    this.mobileThreshold = 601;

    // Bind functions
    //this.onReady = this.onReady.bind(this);
    //this.submitForm = this.submitForm.bind(this);
    //this.successMessage = this.successMessage.bind(this);

    //$(window).on('ajaxSuccess', this.onReady); // Bind ajaxSuccess (custom event, comes from Ajaxy)

    $(document).ready(this.onReady);
  }

  onReady() {
  }
}

export default Shop;