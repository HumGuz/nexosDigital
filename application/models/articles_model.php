<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Articles_model extends CI_Model {
	
		function getArticle(){
			return '
			
				<div class="article">
					<h5 class="head">En noticias recientes</h5>
					<h6>Software </h6>
					<a class="title" href="single.html">DeltaMaker – The new kid on the block An Elegant 3D Printer and a new wicked ass thing</a>
					<a href="single.html"><img src="'.base_url().'application/views/images/a1.jpg" alt="" /></a>
					<p>Products were inspired by Behance\'s research of especially productive teams in the creative industry. Hundreds of individuals and teams were interviewed, and Behance chronicled the work habits and best practices of creative leaders. </p>
					<p>The paper products were initially designed by and for the Behance team as a way to stay organized. In 2007, at the insistence of friends who wanted Action Pads of their own...</p>
				</div>
				<div class="article">
					<h6>Printers</h6>
					<a class="title" href="single.html">Nokia offering customers printable STL phone cases for the Lumia 820 and things </a>
					<a href="single.html"><img src="'.base_url().'application/views/images/a2.jpg" alt="" /></a>
					<p>This week Nokia announced it is giving away files for printable case for it’s new Lumia 820 range. This week Nokia a files for printable case for it’s new Lumia 820 range. This week Nokia announced it is giving away files for printable case for it’s new Lumia 820 range. This week Nokia announced it is giving away files for printable case for it’s new Lumia 820 range. </p>
				</div>
			
			';
		}


		function getFeatures(){ 
			return '				
						<ul>
							<li><a href="#">Fused Filament Fabrication (FFF) using 1.75 mm filament</a></li>
							<li><a href="#">100 micron layer resolution capability</a></li>
							<li><a href="#">9″ diameter x 11″ tall build envelope (approximate)</a></li>
							<li><a href="#">Heated build platform (optional)</a></li>
							<li><a href="#">Efficient footprint to build envelope ratio</a></li>
							<li><a href="#">Printed object viewable from 360 degrees</a></li>
							<li><a href="#">Rigid aluminum extrusion construction</a></li>
							<li><a href="#">Utilizes open source software tool chain</a></li>
						</ul>
			';
		}

	
	
		function getRecent(){
			return '
			
				<div class="article">
					<h5 class="head">En noticias recientes</h5>
					<h6>Software </h6>
					<a class="title" href="5521/'.str_replace(' ', '-', strtolower ('The new kid on the block An Elegant 3D Printer')).'">DeltaMaker – The new kid on the block An Elegant 3D Printer and a new wicked ass thing</a>
					<a href="article/'.str_replace(' ', '-', strtolower ('The new kid on the block An Elegant 3D Printer')).'/5521"><img src="'.base_url().'application/views/images/a1.jpg" alt="" /></a>
					<p>Products were inspired by Behance\'s research of especially productive teams in the creative industry. Hundreds of individuals and teams were interviewed, and Behance chronicled the work habits and best practices of creative leaders. </p>
					<p>The paper products were initially designed by and for the Behance team as a way to stay organized. In 2007, at the insistence of friends who wanted Action Pads of their own...</p>
				</div>
				<div class="article">
					<h6>Printers</h6>
					<a class="title" href="article/'.str_replace(' ', '-', strtolower ('Nokia offering customers printable STL phone cases for the Lumia 820 and things')).'/5521">Nokia offering customers printable STL phone cases for the Lumia 820 and things </a>
					<a href="article/'.str_replace(' ', '-', strtolower ('Nokia offering customers printable STL phone cases for the Lumia 820 and things')).'/5521"><img src="'.base_url().'application/views/images/a2.jpg" alt="" /></a>
					<p>This week Nokia announced it is giving away files for printable case for it’s new Lumia 820 range. This week Nokia a files for printable case for it’s new Lumia 820 range. This week Nokia announced it is giving away files for printable case for it’s new Lumia 820 range. This week Nokia announced it is giving away files for printable case for it’s new Lumia 820 range. </p>
				</div>
			
			';
		}

	   function getPopular(){
	   		return '
	   			
					<a href="article/'.str_replace(' ', '-', strtolower ('The new kid on the block An Elegant 3D Printer')).'/5521">
						<div class="editor text-center">
							<h3>DeltaMaker – The new kid on the block An Elegant 3D Printer</h3>
							<p>A new cheap ass 3D Printer worth checking out</p>
							<label>2 Days Ago</label>
							<span></span>
						</div>
					</a>
					<a class="active" href="article/'.str_replace(' ', '-', strtolower ('Autodesk Inventor Fusion for Mac')).'/5521">
						<div class="editor text-center">
							<h3>Software Review: Autodesk Inventor Fusion for Mac</h3>
							<p>3D Printing, 3D Software</p>
							<label>3 Days Ago</label>
							<span></span>
						</div>
					</a>
					<a href="article/'.str_replace(' ', '-', strtolower ('A new cheap ass 3D Printer worth checking out')).'/5521">
						<div class="editor text-center">
							<h3>DeltaMaker – The new kid on the block An Elegant 3D Printer</h3>
							<p>A new cheap ass 3D Printer worth checking out</p>
							<label>2 Days Ago</label>
							<span></span>
						</div>
					</a>
					<a href="article/'.str_replace(' ', '-', strtolower ('3D Printing, 3D Software')).'/5521">
						<div class="editor text-center">
							<h3>Software Review: Autodesk Inventor Fusion for Mac</h3>
							<p>3D Printing, 3D Software</p>
							<label>3 Days Ago</label>
							<span></span>
						</div>
					</a>
	   		';
	   }

 		function getEditorsPick(){
	   		return '
	   		
					<div class="editors-pic">
						<div class="e-pic">
							<a href="single.html"><img src="'.base_url().'application/views/images/ep1.jpg" alt="" /></a>
						</div>
						<div class="e-pic-info">
							<a href="single.html">MarkerBot Announces the ‘Replicator 2x’  For the Experimental</a>
							<span></span>
							<label>2 Days Ago</label>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="editors-pic">
						<div class="e-pic">
							<a href="single.html"><img src="'.base_url().'application/views/images/ep2.jpg" alt="" /></a>
						</div>
						<div class="e-pic-info">
							<a href="single.html">3D Printed Record – the next revolution?</a>
							<span></span>
							<label>2 Days Ago</label>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="editors-pic">
						<div class="e-pic">
							<a href="single.html"><img src="'.base_url().'application/views/images/ep3.jpg" alt="" /></a>
						</div>
						<div class="e-pic-info">
							<a href="single.html">MarkerBot Announces the ‘Replicator 2x’  For the Experimental</a>
							<span></span>
							<label>2 Days Ago</label>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="editors-pic">
						<div class="e-pic">
							<a href="single.html"><img src="'.base_url().'application/views/images/ep4.jpg" alt="" /></a>
						</div>
						<div class="e-pic-info">
							<a href="single.html">3D Printed Record – the next revolution?</a>
							<span></span>
							<label>2 Days Ago</label>
						</div>
						<div class="clearfix"></div>
					</div>
	   		';
	   }

}