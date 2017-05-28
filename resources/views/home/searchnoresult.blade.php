@extends('layouts.home')
@section('content')
		<div id="content">
			<div class="quest-row site-content">
				<div class="container">
					<div class="row">
						<div id="primary" class="content-area single col-md-9">
							<div id="main" class="site-main" role="main">
								<section class="no-results not-found">
									<header class="page-header">
										<h1 class="page-title">没有搜索到相关博客</h1>
									</header>
									<!-- .page-header -->								
									<div class="page-content">
										<p>对不起，没有搜索到相关的博客项目，请尝试其他关键字。</p>
									</div>
									<!-- .page-content -->								
								</section>

								{{-- <div class="page">{{$data->links()}}</div> --}}
							</div>
							<!-- #main -->
						</div>
						<!-- #primary -->
@endsection