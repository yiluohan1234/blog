@extends('layouts.home')
@section('content')
		<div id="content">
			<div class="quest-row site-content">
				<div class="container">
					<div class="row">
						<div id="primary" class="content-area single col-md-9">
							<div id="main" class="site-main" role="main">
								<article class="post hentry">
									<header class="entry-header">
										<h1 class="post-title">
											{{$field->art_title}}
										</h1>
										<div class="entry-meta">
											<time class="post-date"> <i class="fa fa-clock-o"></i>
												{{date('Y-m-d',$field->art_time)}}
											</time>
											<span class="seperator">/</span>
											<span> <i class="fa fa-user"></i>
												{{$field->art_editor}}
											</span>
											<span class="seperator">/</span>
											<span> <i class="fa fa-bar-chart"></i>
												{{$field->art_view}}
											</span>
										</div>
										<!-- .entry-meta -->
									</header>
									<!-- .entry-header -->
									<div class="entry-content">
										{!!$field->art_content!!}
									</div>
									<!-- .entry-content -->
									<footer class="entry-footer">
										<ul class="post-categories">

											<li>
												<a href="{{url('cate/'.$field->cate_id)}}" rel="category">{{$field->cate_name}}</a>
											</li>
										</ul>

										<ul class="post-tags">
											<li>
												{{$field->art_tag}}
											</li>
										</ul>

									</footer>
									<!-- .entry-footer -->
								</article>
								<!-- #post-## -->
								<!-- UY BEGIN -->
								<div id="uyan_frame"></div>
								<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2134671"></script>
								<!-- UY END -->
							</div>
							<!-- #main -->
						</div>
						<!-- #primary -->
@endsection