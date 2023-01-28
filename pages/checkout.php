<?php
include 'config.php';
include 'shoppingcart.php';
include 'usrinfo.php';


if (is_null($_SESSION['usrAuth'])) {
  header("Location: catologue.php?id=noauth");
}


if(isset($_POST['checkoutbtn']))
{

  if(!empty($_SESSION["shoppingcart"]))  
  {
    $savedata = false;
    foreach($_SESSION["shoppingcart"] as $keys => $values)  
    {
      $savedata = true; 

      $itemid = $values["item_id"];
      $itemPrice = $values["item_price"] * $values["item_quantity"];
      $itemQtn = $values["item_quantity"];
      $sellerId = $values["item_seller"];
      $paymentMethod = $_POST['paymentMethod'];
      $deliveryMethod = $_POST['deliveryMethod'];
      $shippingAddress = $_POST['shipping_add'];

      $args = "INSERT INTO user_orders(user_id, product_id, qtn, delivery, shipping_address, paid) VALUES ($userid, $itemid, $itemQtn, '$deliveryMethod', '$shippingAddress', $itemPrice)";
      $result = mysqli_query($conn, $args);
      if ($result) {
        unset($keys);
      } else {
        echo 'something error';
      }


      $args1 = "UPDATE products SET stock=stock-'$itemQtn' WHERE id='$itemid'";      
      $result = mysqli_query($conn, $args1);
      if ($result) {
        unset($keys);
      } else {
        echo 'something error';
      }

    }
    if (empty($keys))
    {
      unset($_SESSION['shoppingcart']);
      header("Location: thankyou.php");
    }

  }
}
else


$arg = "SELECT product_id from user_orders JOIN users on user_orders.user_id = $userid group by id";
$check = mysqli_query($conn, $arg);






if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'success'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Inquiry succesfully submitted!</h4>
    </div>';
  }elseif($id == 'updated'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> User data succesfully updated!</h4>
    </div>';
  }elseif($id == 'deleted'){
  echo '<div class="alert alert-success" id="flash-msg">
  <h4><i class="icon fa fa-check "></i> User succesfully removed from system!</h4>
  </div>';
  }
}


?>
<!doctype html>
<html lang="en">
 
<?php $pageTitle = "Checkout"; include('./parts/header.php');?>

    <section>
      <div class="container p-5">
        <h1>Checkout your order!</h1>
        <p>Why wait any longer? Make the payment and you're set to go!</p>
      </div>

    <section>
      <div class="container mb-3">
        <?php if($cartno > 0){ ?>

        <div class="row">
          <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Your cart</span>
              <span class="badge badge-secondary badge-pill">4</span>
            </h4>
            <ul class="list-group mb-3">
              <?php foreach($_SESSION["shoppingcart"] as $keys => $values){ ?>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0"><?php echo $values["item_name"]; ?></h6>
                  <small class="text-muted">Product ID: <?php echo $values["item_id"]; ?></small>

                </div>
                <span class="text-muted">MYR <?php echo $values["item_price"]; ?> x<?php echo $values["item_quantity"]; ?></span>
              </li>
              <?php } ?>
              <li class="list-group-item d-flex justify-content-between">
                <?php $total = 0;foreach($_SESSION["shoppingcart"] as $keys => $values){ 
                  $total = $total + ($values["item_price"] * $values["item_quantity"] );}?>
                <span>Total</span>
                <strong>MYR <?php echo number_format($total, 2); ?></strong>
              
              </li>
            </ul>

          </div>
          <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form method="POST" action="" class="needs-validation" validate>
              <input type="hidden" value="<?php echo $total; ?>" name="totalPrice">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $firstname; ?>" required>
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Last name</label>
                  <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $lastname; ?>" required>
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $email; ?>">
                <div class="invalid-feedback">
                  Please enter a valid email address for shipping updates.
                </div>
              </div>

              <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="shipping_add" placeholder="1234 Main St" required>
                <div class="invalid-feedback">
                  Please enter your shipping address.
                </div>
              </div>

              <div class="mb-3">
                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
              </div>

              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="country">Country</label>
                  
                  <select class="custom-select d-block w-100" id="country" required>
                    <option>Select country</option>
                    <option value="AF">Afghanistan</option>
                    <option value="AX">Aland Islands</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarctica</option>
                    <option value="AG">Antigua and Barbuda</option>
                    <option value="AR">Argentina</option>
                    <option value="AM">Armenia</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="AZ">Azerbaijan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesh</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Belarus</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivia</option>
                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                    <option value="BA">Bosnia and Herzegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BV">Bouvet Island</option>
                    <option value="BR">Brazil</option>
                    <option value="IO">British Indian Ocean Territory</option>
                    <option value="BN">Brunei Darussalam</option>
                    <option value="BG">Bulgaria</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Cambodia</option>
                    <option value="CM">Cameroon</option>
                    <option value="CA">Canada</option>
                    <option value="CV">Cape Verde</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CC">Cocos (Keeling) Islands</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros</option>
                    <option value="CG">Congo</option>
                    <option value="CD">Congo, Democratic Republic of the Congo</option>
                    <option value="CK">Cook Islands</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Cote D'Ivoire</option>
                    <option value="HR">Croatia</option>
                    <option value="CU">Cuba</option>
                    <option value="CW">Curacao</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="DJ">Djibouti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominican Republic</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Equatorial Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estonia</option>
                    <option value="ET">Ethiopia</option>
                    <option value="FK">Falkland Islands (Malvinas)</option>
                    <option value="FO">Faroe Islands</option>
                    <option value="FJ">Fiji</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="GF">French Guiana</option>
                    <option value="PF">French Polynesia</option>
                    <option value="TF">French Southern Territories</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgia</option>
                    <option value="DE">Germany</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Greece</option>
                    <option value="GL">Greenland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GG">Guernsey</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="HM">Heard Island and Mcdonald Islands</option>
                    <option value="VA">Holy See (Vatican City State)</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Hungary</option>
                    <option value="IS">Iceland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IR">Iran, Islamic Republic of</option>
                    <option value="IQ">Iraq</option>
                    <option value="IE">Ireland</option>
                    <option value="IM">Isle of Man</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japan</option>
                    <option value="JE">Jersey</option>
                    <option value="JO">Jordan</option>
                    <option value="KZ">Kazakhstan</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KP">Korea, Democratic People's Republic of</option>
                    <option value="KR">Korea, Republic of</option>
                    <option value="XK">Kosovo</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kyrgyzstan</option>
                    <option value="LA">Lao People's Democratic Republic</option>
                    <option value="LV">Latvia</option>
                    <option value="LB">Lebanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libyan Arab Jamahiriya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MO">Macao</option>
                    <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
                    <option value="MG">Madagascar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldives</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritania</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexico</option>
                    <option value="FM">Micronesia, Federated States of</option>
                    <option value="MD">Moldova, Republic of</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolia</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Morocco</option>
                    <option value="MZ">Mozambique</option>
                    <option value="MM">Myanmar</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Netherlands</option>
                    <option value="AN">Netherlands Antilles</option>
                    <option value="NC">New Caledonia</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk Island</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PS">Palestinian Territory, Occupied</option>
                    <option value="PA">Panama</option>
                    <option value="PG">Papua New Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PN">Pitcairn</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Qatar</option>
                    <option value="RE">Reunion</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russian Federation</option>
                    <option value="RW">Rwanda</option>
                    <option value="BL">Saint Barthelemy</option>
                    <option value="SH">Saint Helena</option>
                    <option value="KN">Saint Kitts and Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="MF">Saint Martin</option>
                    <option value="PM">Saint Pierre and Miquelon</option>
                    <option value="VC">Saint Vincent and the Grenadines</option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">Sao Tome and Principe</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbia</option>
                    <option value="CS">Serbia and Montenegro</option>
                    <option value="SC">Seychelles</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapore</option>
                    <option value="SX">Sint Maarten</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="SB">Solomon Islands</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">South Africa</option>
                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                    <option value="SS">South Sudan</option>
                    <option value="ES">Spain</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SD">Sudan</option>
                    <option value="SR">Suriname</option>
                    <option value="SJ">Svalbard and Jan Mayen</option>
                    <option value="SZ">Swaziland</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="SY">Syrian Arab Republic</option>
                    <option value="TW">Taiwan, Province of China</option>
                    <option value="TJ">Tajikistan</option>
                    <option value="TZ">Tanzania, United Republic of</option>
                    <option value="TH">Thailand</option>
                    <option value="TL">Timor-Leste</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad and Tobago</option>
                    <option value="TN">Tunisia</option>
                    <option value="TR">Turkey</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks and Caicos Islands</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US">United States</option>
                    <option value="UM">United States Minor Outlying Islands</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Uzbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VE">Venezuela</option>
                    <option value="VN">Viet Nam</option>
                    <option value="VG">Virgin Islands, British</option>
                    <option value="VI">Virgin Islands, U.s.</option>
                    <option value="WF">Wallis and Futuna</option>
                    <option value="EH">Western Sahara</option>
                    <option value="YE">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid country.
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                <label for="zip">State</label>
                  <input type="text" class="form-control" id="zip" placeholder="" required>
                  <div class="invalid-feedback">
                    State required.
                  </div>
                  <div class="invalid-feedback">
                    Please provide a valid state.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="zip">Zip</label>
                  <input type="text" class="form-control" id="zip" placeholder="" required>
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>
                </div>
              </div>
              <hr class="mb-4">
              <h4 class="mb-3">Method of Delivery</h4>

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="dlv" value="Delivery" name="deliveryMethod" type="radio" class="custom-control-input mr-3" selected required>
                  <label class="custom-control-label mr-3" for="dlv">Delivery</label>
      
                  <input id="slp" value="Self-pickup" name="deliveryMethod" type="radio" class="custom-control-input mr-3" required>
                  <label class="custom-control-label mr-3" for="slp">Self-pickup</label>
                </div>
              </div>

              <hr class="mb-4">
              <h4 class="mb-3">Payment</h4>

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="credit" value="Credit/Debit Card" name="paymentMethod" type="radio" class="custom-control-input mr-3" required>
                  <label class="custom-control-label mr-3" for="credit">Credit/Debit Card</label>
      
                  <input id="ewt" value="e-Wallet" name="paymentMethod" type="radio" class="custom-control-input mr-3" required>
                  <label class="custom-control-label mr-3" for="ewt">e-Wallet</label>

                  <input id="fpx" value="Online Banking" name="paymentMethod" type="radio" class="custom-control-input ml-3" required>
                  <label class="custom-control-label mr-3" for="fpx">Online Banking</label>

                  <input id="cod" value="Cash on Delivery" name="paymentMethod" type="radio" class="custom-control-input ml-3" required>
                  <label class="custom-control-label mr-3" for="cod">Cash on Delivery</label>
                </div>
              </div>

              <div class="credit box">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="cc-name">Name on card</label>
                    <input type="text" class="form-control" id="cc-name" placeholder="" >
                    <small class="text-muted">Full name as displayed on card</small>
                    <div class="invalid-feedback">
                      Name on card is required
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="cc-number">Credit card number</label>
                    <input type="text" class="form-control" id="cc-number" placeholder="" >
                    <div class="invalid-feedback">
                      Credit card number is required
                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Expiration</label>
                    <input type="text" class="form-control" id="cc-expiration" placeholder="" >
                    <div class="invalid-feedback">
                      Expiration date required
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="cc-expiration">CVV</label>
                    <input type="text" class="form-control" id="cc-cvv" placeholder="" >
                    <div class="invalid-feedback">
                      Security code required
                    </div>
                  </div>
                </div>
              </div>

              <div class="ewt box">
                <div class="dropdown-divider"></div>
                <p>Choose e-Wallet:</p>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <input id="grab" value="" name="selectedeWallet" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="grab">Grab e-Wallet</label>
                  </div>
                  <div class="col-md-3 mb-3">
                    <input id="tng" value="" name="selectedeWallet" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="tng">Touch n Go</label>
                  </div>
                  <div class="col-md-3 mb-3">
                    <input id="boost" value="" name="selectedeWallet" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="boost">Boost</label>
                  </div>
                </div>
              </div>

              <div class="fpx box">
                <div class="dropdown-divider"></div>
                <p>Choose Bank:</p>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <input id="Maybank" value="Maybank" name="selectedBank" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="Maybank">Maybank</label>
                  </div>
                  <div class="col-md-3 mb-3">
                    <input id="CIMB" value="CIMB" name="selectedBank" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="CIMB">CIMB</label>
                  </div>
                  <div class="col-md-3 mb-3">
                    <input id="AmBank" value="AmBank" name="selectedBank" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="AmBank">AmBank</label>
                  </div>
                  <div class="col-md-3 mb-3">
                    <input id="HSBC" value="HSBC" name="selectedBank" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="HSBC">HSBC</label>
                  </div>
                  <div class="col-md-3 mb-3">
                    <input id="Islam" value="Bank Islam" name="selectedBank" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="Islam">Bank Islam</label>
                  </div>
                  <div class="col-md-3 mb-3">
                    <input id="Public" value="Public Bank" name="selectedBank" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="Public">Public Bank</label>
                  </div>
                  <div class="col-md-3 mb-3">
                    <input id="Affin" value="Affin Bank" name="selectedBank" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="Affin">Affin Bank</label>
                  </div>
                  <div class="col-md-3 mb-3">
                    <input id="RHB" value="RHB" name="selectedBank" type="radio" class="custom-control-input mr-3" >
                    <label class="custom-control-label mr-3" for="RHB">RHB</label>
                  </div>
                </div>
              </div>

              <div class="cod box">
              <p>Payment is to be collected during the delivery of the goods.</p>
              </div>

              <hr class="mb-4">
              <div class="d-grid">
                <input class="btn btn-success btn" name="checkoutbtn" type="submit" value="Pay"/>
              </div>
            </form>
          </div>
        </div>
      <?php }else{ ?>
        <div class="alert alert-secondary" role="alert">
          Your cart is currently empty.
        </div>



      <?php } ?>
      </div>



    </section>



    <?php include('./parts/footer.php');?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("id");
        var targetBox = $("." + inputValue);
        if ($(this).attr("name") != "selectedBank" && $(this).attr("name") != "selectedeWallet" && $(this).attr("name") != "deliveryMethod") {
          $(".box").not(targetBox).hide();
          $(targetBox).show();
        } else {
          
        }
        // $(".box").not(targetBox).hide();
        // $(targetBox).show();
    });
});
</script>
</html>