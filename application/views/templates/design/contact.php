
<div class="container">
  <section id="section_signup_tabs" class='contact_us_form'>
    <div class="row">
      <div class="col-md-12">
      <?php if(!$this->session->flashdata('message')){?>
      <?php echo validation_errors(); ?>
        <div>
        <form action="" class="form" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="">What's your name?</label>
                  <input type="text" id="name" name="name" placeholder="Full Name" class="form-control">
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">What's your email?</label>
                  <input type="text" id="email" placeholder="i.e. email@domain.co.nz" name="email" class="form-control">
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                  <label for="contact">What's your contact?</label>
                  <input type="text" id="contact" name="contact" placeholder="123456789" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="message">Write your message below</label>
                  <textarea class="form-control" name="message" rows="15" placeholder="i.e. I have a query..." id="message"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <button class="btn inverted" type="submit" name="submit" id="submit">Submit</button>
              </div>
            </div>
            <br><br>
          </div>
        </form>
      </div>

      <?php } else{?>
        <div class="row">
          <div class="col-md-12">
            <?php echo $this->session->message; ?>
            <p><a href="<?php echo site_url('design/contact'); ?>" class="btn inverted">&laquo; Go Back</a></p>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>

</div> <!-- contanier ends here -->

<div class="container-fluid">
	<section id="image_section">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1 class="light_font">Some other title here</h1>
				<h2 class="bold">Some subtitle text here</h2>
				<a href="<?php echo site_url('design/lawyer_register_your_interest')?>" class="btn black">Register Interest</a>
			</div>
		</div>
	</section>
