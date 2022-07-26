<div class="row">
    <div class="col-md-3"></div>
<div class="card col-md-6">
 <form action="<?= base_url();?>dashboard/create" method="POST" id="payment-form">
        <div class="card-heading">
            <input type="hidden" name="subscr_plan" value="<?php echo $this->input->get('planid');?>">
            <input type="hidden" name="price" value="<?php echo $this->input->get('price');?>">
            <input type="hidden" name="amount" value="<?php echo $this->input->get('amount');?>">


        </div>
        <div class="card-body row">
            <!-- Display errors returned by createToken -->
            <div id="paymentResponse" class=""></div>
			
            <!-- Payment form -->
            <div class="form-group col-md-6">
                <label  class="form-label">FIRST NAME</label>
                <input type="text" name="first_name" id="name" class="form-control" placeholder="Enter First Name" required="" autofocus="" value="<?= set_value('first_name');?>">
            </div>
            <div class="form-group col-md-6">
                <label class="form-label">LAST NAME</label>
                <input type="text" name="last_name" id="name" class="form-control" placeholder="Enter Last Name" required="" autofocus="" value="<?= set_value('last_name');?>">
            </div>
            <div class="form-group col-md-6">
                <label class="form-label">EMAIL</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required="" value="<?= set_value('email');?>">
            </div>
            
            <div id="card-element" class="mt-4">
                <!-- Elements will create input elements here -->
            </div>
              <!-- We'll put the error messages in this element -->
            <div id="card-errors" role="alert"></div>
            
            <button id="submit" type="submit" class="btn btn-success mt-4">Submit Payment</button>

        </div>
    </form>
   
    </div>
    <div class="col-md-3"></div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
    // Create an instance of the Stripe object
    // Set your publishable API key
    var stripe = Stripe('pk_test_51LOQa8SClFQlcpYnGFFUWy73OS4ttvqR0YVOUHAAfndP7AmbXu9fvpbQoK520uhNdFeoPVxCERTRag9y2KZIENuH000n2dBHfJ');

    // Create an instance of elements
    var elements = stripe.elements();

    var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: '#32325d',
        },
        };

    var card = elements.create("card", { style: style });
    card.mount("#card-element");

    card.on('change', ({error}) => {
    let displayError = document.getElementById('card-errors');
    if (error) {
        displayError.textContent = error.message;
    } else {
        displayError.textContent = '';
    }
    });

// Create a token or display an error when the form is submitted.
var form = document.getElementById('payment-form');

form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the customer that there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  HTMLFormElement.prototype.submit.call(form);
}


</script>