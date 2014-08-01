<% include MainNav %>
<br>
<div class="container">
	<% include BreadCrumbs %>
	<div class="row clearfix">
		<div class="col-md-8">
<h1>$Title</h1>
	    	<% if $Query %>
	    		<p class="searchQuery">You searched for &quot;{$Query}&quot;</p>
	    	<% end_if %>

		    <% if $Results %>
		    <ul id="SearchResults">
		        <% loop $Results %>
		        <li>
		            <h4>
		                <a href="$Link">
		                    <% if $MenuTitle %>
		                    $MenuTitle
		                    <% else %>
		                    $Title
		                    <% end_if %>
		                </a>
		            </h4>
		            <% if $Content %>
		                <p>$Content.Summary(30)</p>
		            <% end_if %>
		            <a class="readMoreLink" href="$Link" title="Read more about &quot;{$Title}&quot;">Continue Reading</a>
		        </li>
		        <hr />
		        <% end_loop %>
		    </ul>
		    <% else %>
		    	<p>Sorry, your search query did not return any results.</p>
		    <% end_if %>

		    <% if $Results.MoreThanOnePage %>
		    <div id="PageNumbers">
		        <div class="pagination">
		            <% if $Results.NotFirstPage %>
		            <a class="prev" href="$Results.PrevLink" title="View the previous page">&larr;</a>
		            <% end_if %>
		            <span>
		                <% loop $Results.Pages %>
		                    <% if $CurrentBool %>
		                    $PageNum
		                    <% else %>
		                    <a href="$Link" title="View page number $PageNum" class="go-to-page">$PageNum</a>
		                    <% end_if %>
		                <% end_loop %>
		            </span>
		            <% if $Results.NotLastPage %>
		            <a class="next" href="$Results.NextLink" title="View the next page">&rarr;</a>
		            <% end_if %>
		        </div>
		        <p>Page $Results.CurrentPage of $Results.TotalPages</p>
		    </div>
		    <% end_if %>
	            	
		</div><!-- end .col-md-8 -->
  		<div class="col-md-4">
  			<% include BlogSideBar %>
  		</div>
	</div>
</div>