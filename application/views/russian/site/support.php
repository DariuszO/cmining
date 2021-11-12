<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- Begin page-broadcom -->
		<div class="section overlay-80 page-broadcom broadcom-bg slider-bottom-fix ptb-110"> 
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumb-wrap">
							<ol class="breadcrumb text-left">
							  <li class="breadcrumb-item"><a href="/">Главная</a></li>
							  <li class="breadcrumb-item active">Контакты</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- End page-broadcom -->
        <!-- Begin intro-section -->
        <div class="intro-section clear bg-white ptb-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Begin section-title -->
                                <div class="section-title title-divider text-left mb-40">
                                    <h3 class="title">Обратная связь</h3>
                                    
                                </div>
                                <!-- End section-title -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contents">
                                <?=$this->session->flashdata("error"); ?>
                                
                                <form action="" method="POST">
	                                <div class="row">
	                                    <div class="form-group">
	                                        <div class="col-lg-12 col-md-12">
	                                            <label> Имя *</label>
	                                            <input value="" class="form-control" name="name" id="name" type="text">
	                                        </div>
	                                        <div class="col-lg-12 col-md-12">
	                                            <label> Email *</label>
	                                            <input value="" class="form-control" name="email" id="email" type="email">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="form-group">
	                                        <div class="col-lg-12 col-md-12">
	                                            <label>Сообщение *</label>
	                                            <textarea rows="8" class="form-control" name="text" id="comment"></textarea>
	                                        </div>
	                                    </div>
	                                </div>
	                                 <div class="row">
	                                    <div class="form-group">
	                                        <div class="col-lg-12 col-md-12">
	                                            <label></label>
	                                            <div class="g-recaptcha" data-sitekey="<?=$this->config->item('PublicKeyRecaptcha');?>"></div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-lg-12 col-md-12 mt-10">
	                                        <button type="submit" class="button-primary effect-sweep">Отправить сообщение</button>
	                                    </div>
	                                </div>
	                               
	                            </form>
                                
                                
                                
                                
                                
                                
                                
                                
                                </div>
                            </div>
                            
                            
                            
                         </div>
                    </div>
                    
                </div>
            </div>
        </div>
                                
                                