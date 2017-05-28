@extends('layouts.home')
@section('content')
		<div id="content">
			<div class="quest-row site-content">
				<div class="container">
					<div class="row">
						<div id="primary" class="content-area single col-md-9">
							<div id="main" class="site-main" role="main">
								@foreach($data as $p)
								<article class="post hentry">
									<!-- .entry-header -->
									<header class="entry-header">
										<h1 class="post-title">
											<a href="{{url('article/'.$p->art_id)}}" rel="bookmark">{{$p->art_title}}</a>
										</h1>
										<div class="entry-meta">
											<time class="post-date"> <i class="fa fa-clock-o"></i>
												{{date('Y-m-d',$p->art_time)}}
											</time>
											<span class="seperator">/</span>
											<span> <i class="fa fa-user"></i>
												{{$p->art_editor}}
											</span>
											<span class="seperator">/</span>
											<span> <i class="fa fa-bar-chart"></i>
												{{$p->art_view}}
											</span>
										</div>
										<!-- .entry-meta -->
									</header>
									<!-- .entry-header -->
									<!-- .entry-content -->
									<div class="entry-content">
										<p>{{$p->art_description}}</p>
									</div>
									<!-- .entry-content -->
									<!-- .entry-footer -->
									<footer class="entry-footer">
										<ul class="post-categories">
											<li>
												<a href="{{url('category/'.$p->cate_id)}}" rel="category">{{$id_name[$p->cate_id]}}</a>
											</li>
										</ul>
										<ul class="post-tags">
											<li>
												{{$p->art_tag}}
											</li>
										</ul>
										<!--去除阅读全文
										<div class="read-more">
											<a href="/blog/posts/welcome.html">
												阅读全文
												<i class="fa fa-angle-double-right "></i>
											</a>
										</div>
										-->
									</footer>
									<!-- .entry-footer -->
								</article>
								@endforeach
								<div class="page">{{$data->links()}}</div>
							</div>
							<!-- #main -->
						</div>
						<!-- #primary -->
@endsection