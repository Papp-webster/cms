<footer class="bottom">
  <div class="under">
    <div class="row text-center text-xs-center text-md-left down">
      <div class="col-md-6">
        <ul>
          <h3>Elérhetőség</h3>
          <li><i class="fa fa-envelope-open" aria-hidden="true"></i><a href="#">4700, Mátészalka, Kossuth u. 43.</a></li>
          <li>
            <i class="fa fa-envelope"></i>
            <a href="#" id="Btn" data-toggle="modal" data-target="#emailmodal">

              <span>Email</span>
            </a>
          </li>
          <li><i class="fab fa-facebook-f" aria-hidden="true"></i><a href="https://www.facebook.com/%C3%89lhet%C5%91-M%C3%A1t%C3%A9szalka-1139052266298049/">Élhető Mátészalka</a></li>
          <li><i class="fa fa-phone-square" aria-hidden="true"></i><a href="#">+36 20 9405848</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="copy">&copy; MSZTESZ Élhető Mátészalka</div>
  <div class="dmtop">Scroll to Top</div>
  <!-- modal email -->

  <div class="modal fade" id="emailmodal" tabindex="-1" role="dialog" aria-labelledby="emailmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">




        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="form-main text-center" id="emailmodal">Email</h4>



          <!--Card content-->
          <div class="card-body px-lg-8 pt-0">
            <div id="success"></div>
            <p class="error text-center">* Kötelező mezők!</p>
            <!-- Form -->
            <form id="contactForm" class="text-center" action="/cms/mail/contact_me.php" name="sentMessage" novalidate="novalidate" autocomplete="off" method="post">

              <!-- Name -->
              <div class="form-group">
                <label for="materialContactFormName">Név</label>
                <input type="text" id="name" class="user form-control" placeholder="*Teljes név" name="name" required="required" data-validation-required-message="Adja meg a nevét!">
                <p class="help-block text-danger"></p>
              </div>

              <!-- E-mail -->
              <div class="form-group">
                <label for="materialContactFormEmail">E-mail</label>
                <input type="email" id="email" class="user form-control" placeholder="*Email" name="email" required="required" data-validation-required-message="Adja meg az email címét!">
                <p class="help-block text-danger"></p>
              </div>

              <!-- Subject -->
              <span>Tárgy:</span>
              <select name="obj" id="obj" from="contactForm">
                <option value="" disabled>Válassz opciót:</option>
                <option value="Észrevétel" selected>Észrevétel</option>
                <option value="Kérdés">Kérdés</option>
              </select>
              <br><br>

              <!--Message-->
              <div class="form-group">
                <textarea id="message" class="form-control" rows="3" placeholder="Üzenet" name="message" required="required" data-validation-required-message="Írjon üzenetet!"></textarea>
                <p class="help-block text-danger"></p>
              </div>

              <button id="sendMessageButton" class="btn login" type="submit">Elküld</button>

            </form>
            <!-- Form -->

          </div>


          <!-- Material form contact -->
        </div>

      </div>
    </div>
  </div>

</footer>
<?php

$version = 1;
?>

<!-- jQuery -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="/cms/js/bootstrap.min.js"></script>
<script src="/cms/js/pageloader.js?data=<?php echo $version; ?>"></script>
<script src="/cms/js/swiped-events.js?data=<?php echo $version; ?>"></script>
<script src="/cms/js/form.js?data=<?php echo $version; ?>"></script>
<script src="/cms/js/jqBootstrapValidation.js?data=<?php echo $version; ?>"></script>
<script src="/cms/js/contact.js?data=<?php echo $version; ?>"></script>

</body>

</html>