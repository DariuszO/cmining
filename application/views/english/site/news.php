<!-- Begin page-broadcom -->
		<div class="section overlay-80 page-broadcom broadcom-bg slider-bottom-fix ptb-110"> 
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumb-wrap">
							<ol class="breadcrumb text-left">
							  <li class="breadcrumb-item"><a href="/">Home</a></li>
							  <li class="breadcrumb-item active">News</li>
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
                                    <h3 class="title">News bitaltearning.com</h3>
                                    
                                </div>
                                <!-- End section-title -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contents">
                                
                                
                               <?
                               foreach($NewsList as $List):
                               ?>
                               
                               <div class="post-wrapper">
                            <div class="post-img blog-heffect">
                                <img src="/tpl/site/img/news.jpg" width="800px" alt="">
                                
                            </div>
                            <div class="post-info">
                                
                                <div class="post-info-right">
                                    <a href="#" class="post-like">
                                        <i class="icofont icofont-time"></i> <?=$List->nDateAdd;?>
                                    </a>
                                    
                                </div>
                            </div>
                            <div class="post-content">
                                <h3 class="semi-title theme-text-color"><?=$List->nTheme_en;?></h3>
                                <p><?=$List->nNews_en;?></p>
                            </div>
                        </div>
                               
                               
                               <hr>
                            
                            	<? endforeach; ?>
                                
                                
                                </div>
                            </div>
                            
                         </div>
                    </div>
                    
                </div>
            </div>
        </div>
                                
                                