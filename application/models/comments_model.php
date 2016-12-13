<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comments_model extends CI_Model {
		public function __construct(){
	    	parent::__construct();			
	    }
		
		function getComments(){
			return '
					<div class="comments-main">
								<div class="col-md-3 cmts-main-left">
									<img src="images/avatar.jpg" alt="">
								</div>
								<div class="col-md-9 cmts-main-right">
									<h5>TOM BROWN</h5>
									<p>
										Vivamus congue turpis in laoreet sem nec ultrices. Fusce blandit nunc vehicula massa vehicula tincidunt. Nam venenatis cursus urna sed gravida. Ut tincidunt elit ut quam malesuada consequat. Sed semper purus sit amet lorem elementum faucibus.
									</p>
									<div class="cmts">
										<div class="col-md-6 cmnts-left">
											<p>
												On April 14, 2014, 18:01
											</p>
										</div>
										<div class="col-md-6 cmnts-right">
											<a href="#">Reply</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="comments-main">
								<div class="col-md-3 cmts-main-left">
									<img src="images/avatar.jpg" alt="">
								</div>
								<div class="col-md-9 cmts-main-right">
									<h5>MARK JOHNSON</h5>
									<p>
										Vivamus congue turpis in laoreet sem nec ultrices. Fusce blandit nunc vehicula massa vehicula tincidunt. Nam venenatis cursus urna sed gravida. Ut tincidunt elit ut quam malesuada consequat. Sed semper purus sit amet lorem elementum faucibus.
									</p>
									<div class="cmts">
										<div class="col-md-6 cmnts-left">
											<p>
												On April 14, 2014, 18:01
											</p>
										</div>
										<div class="col-md-6 cmnts-right">
											<a href="#">Reply</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
			
			';
		}
	
	
		

}