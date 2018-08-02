
$Header

<main class="main-content__container" id="main-content__container">

	$BlockArea(BeforeContent)

	<div class="row">
		<div class="featured-news clearfix">
			<div class="featured-news__large-column">
				<% loop $PaginatedList.limit(1) %>
					<div class="news-card news-card--large news-card--border">
						<% if $FeaturedImage %>
							<div class="news-card__thumb">
								<a href="$Link"><img src="$FeaturedImage.CroppedFocusedImage(600,400).URL" alt="$Title"></a>
								<% if $Departments %>
									<span class="news-card__dept news-card__dept--wthumb">
										<% loop $Departments %><% if not $First && $Last %>, <% end_if %>$Title<% end_loop %>
									</span>
								<% end_if %>
							</div>
							<% else %>
								<div class="news-card__thumb">
								<a href="$Link"><img src="{$ThemeDir}/dist/images/news-placeholder-s.jpg" alt="$Title" class="news-main__img"></a>
								<% if $Departments %>
									<span class="news-card__dept news-card__dept--wthumb">
										<% loop $Departments %><% if not $First && $Last %>, <% end_if %>$Title<% end_loop %>
									</span>
								<% end_if %>
							</div>

						<% end_if %>
						<div class="news-card__body text-center">
							<h1 class="news-card__title"><a href="#"><a href="$Link">$Title</a></h1>
							<% if $Summary %>
								<div class="news-card__desc">$Summary</div>
							<% else %>
								<p class="news-card__desc">$Content.LimitCharacters(110)</p>
							<% end_if %>

							<% if $Credits %><div class="news-card__author">By <% loop $Credits %><% if not $First && not $Last %>, <% end_if %><% if not $First && $Last %><span class="byline__and"> and </span><% end_if %><span class="byline__author">$FirstName $Surname</span><% end_loop %></div><% end_if %>

						</div>
					</div>
				<% end_loop %>
			</div>

			<div class="featured-news__medium-column">
				<% loop $PaginatedList.limit(2, 1) %>
				<div class="news-card">
					<% if $FeaturedImage %>
						<div class="news-card__thumb">
							<a href="$Link"><img src="$FeaturedImage.CroppedFocusedImage(450,300).URL" alt="$Title"></a>
							<% if $Departments %>
								<span class="news-card__dept news-card__dept--wthumb">
									<% loop $Departments %><% if not $First && $Last %>, <% end_if %>$Title<% end_loop %>
								</span>
							<% end_if %>
						</div>
					<% end_if %>
					<div class="news-card__body">
						<% if $Departments && not $FeaturedImage %>
							<span class="news-card__dept">
								<% loop $Departments %><% if not $First && $Last %>, <% end_if %>$Title<% end_loop %>
							</span>
						<% end_if %>
						<h2 class="news-card__title news-card__title--small">
							<a href="$Link">$Title</a>
						</h2>
						<% if $Credits %><div class="news-card__author">By <% loop $Credits %><% if not $First && not $Last %>, <% end_if %><% if not $First && $Last %><span class="byline__and"> and </span><% end_if %><span class="byline__author">$FirstName $Surname</span><% end_loop %></div><% end_if %>
					</div>
				</div>
				<% end_loop %>
			</div>
			<div class="featured-news__small-column featured-news__small-column--border">
				<div class="trending">
					<h3 class="trending__heading">Trending</h3>
					<ol class="trending__list">
						<% loop $TrendingPosts.limit(4) %>
						<li class="trending__card">
							<div class="trending__body">
								<% if $Departments %>
									<span class="trending__dept">
										<% loop $Departments %><% if not $First && $Last %>, <% end_if %>$Title<% end_loop %>
									</span>
								<% end_if %>
								<h2 class="trending__title">
									<a href="$Link">$Title</a>
								</h2>
							</div>
						</li>
						<% end_loop %>
					</ol>
				</div>
			</div>
		</div>
	</div><!-- end .row -->

	<!-- Begin Iowa Now News Feed -->
	<div class="news-fullwidth">
		<div class="row">
			<div class="iowa-now">
				<div class="line-header">
					<h2>Student Life In The News</h2>
				</div>
				<ol class="iowa-now__list">
					<% loop RSSDisplay %>
					<li class="iowa-now__item">
						<div class="iowa-now__body">
							<div class="">
								<h2 class="iowa-now__title"><a href="$Link">$Title</a></h2>
								<span class="iowa-now__date"><em>Iowa Now</em> $Date.Format("M j, Y")</span>
							</div>
						</div>
					</li>
					<% end_loop %>
				</ol>
			</div>
		</div>
	</div><!-- End Iowa Now News -->

	<div class="row">
		<div class="title-fullwidth">
			<h2>Latest News</h2>
		</div>

		<div role="main" class="main-content main-content--with-padding <% if $Children || $Menu(2) || $SidebarBlocks ||  $SidebarView.Widgets %>main-content--with-sidebar<% else %>main-content--full-width<% end_if %>">

			$BlockArea(BeforeContentConstrained)

			<div class="main-content__text">

				<% loop $PaginatedList.limit(10) %>
					<% include BlogCard %>
				<% end_loop %>

				<br /><br />

				$BlockArea(AfterContentConstrained)
				$Form
				$CommentsForm
			</div>
		</div>

		<aside class="sidebar dp-sticky">
			<% include SideNav %>


				<%-- Begin Listing Departments --%>
				<div class="WidgetHolder BlogCategoriesWidget first last">
					<h3>Departments</h3>
					<ul>
						<% loop DepartmentsWithPosts %>
						<li><a href="$Link" title=""><span class="text">$Title</span></a></li>
						<% end_loop %>
					</ul>
				</div>
				<%-- End Listing Departments --%>
			<% if $SideBarView %>
				$SideBarView
			<% end_if %>

			$BlockArea(Sidebar)

		</aside>
	</div>

	$BlockArea(AfterContent)

</main>