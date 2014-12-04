// takes the form field value and returns true on valid number
function valid_credit_card(value) {
  // accept only digits, dashes or spaces
  if (/[^0-9-\s]+/.test(value)) return false;

  // The Luhn Algorithm. It's so pretty.
  var nCheck = 0, nDigit = 0, bEven = false;
  value = value.replace(/\D/g, "");

  for (var n = value.length - 1; n >= 0; n--) {
    var cDigit = value.charAt(n),
        nDigit = parseInt(cDigit, 10);

    if (bEven) {
      if ((nDigit *= 2) > 9) nDigit -= 9;
    }

    nCheck += nDigit;
    bEven = !bEven;
  }

  return (nCheck % 10) == 0;
}

function validate() {
  var person = $("input.person").val();
  if (person == "") {
    alert("Fill in person field");
    return false;
  }
  var gender = $('input:radio[name=sex]:checked').val();
  if (gender == null) {
    alert("Fill in gender field");
    return false;
  }
  var adjective = $("input.adjective").val();
  if (adjective == "") {
    alert("Fill in adjective field");
    return false;
  }
  var adjective2 = $("input.adjective2").val();
  if (adjective2 == "") {
    alert("Fill in adjective2 field");
    return false;
  }
  var noun = $("input.noun").val();
  if (noun == "") {
    alert("Fill in noun field");
    return false;
  }

  var number = $("input.number").val();
  if (number < 5 || number == null || isNaN(number)) {
    alert("Fill in the number field correctly");
    return false;
  }
  var noun2 = $("input.plural-noun").val();
  if (noun2 == "") {
    alert("Fill in the noun field");
    return false;
  }
  var verb = $("input.verb").val();
  if (verb == "") {
    alert("Fill in the verb field");
    return false;
  }

  var checkbox = $('#check-submit').is(':checked');
  if (!checkbox) {
    alert("Please check the submit checkbox");
    return false;
  }

  var creditCard = $('#creditCard').val();
  if (!valid_credit_card(creditCard)) {
    alert("Enter a valid credit card number");
    return false;
  }

  return true;
}



$(function() {

  // hide the story from view
  $("#story").hide();

  // ---- event handler ---- //
  $("#btn-click").click(function(e) {

    if (!validate()) {
      return false;
    }

    // grab the values from the input boxes, then append them to the DOM
    $(".person").empty().append($("input.person").val());
    $(".gender").empty().append($('input:radio[name=sex]:checked').val());
    $(".adjective").empty().append($("input.adjective").val());
    $(".adjective2").empty().append($("input.adjective2").val());
    $(".season").empty().append($('#season').find(":selected").text());
    $(".noun").empty().append($("input.noun").val());
    $(".number").empty().append($("input.number").val());
    $(".noun2").empty().append($("input.plural-noun").val());
    $(".verb").empty().append($("input.verb").val());

    // show the story
    $("#story").show();

    // empty the form's values
    $(':input').val('');

    // hide the questions
    $("#questions").hide();

  });

  // ---- event handler ---- //
  $("#play-btn").click(function(e) {
    $("#questions").show();   
    $("#story").hide();
  });

});
