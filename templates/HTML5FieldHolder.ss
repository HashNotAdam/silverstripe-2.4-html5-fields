<div id="$Name" class="field $Type $extraClass">
	<% if Title %><label class="left" for="$ID">$Title</label><% end_if %>
	<div class="middleColumn">$RenderedField</div>
	<% if RightTitle %><label class="right" for="$ID">$RightTitle</label><% end_if %>
	<% if Message %><span class="message $MessageType">$Message</span><% end_if %>
</div>