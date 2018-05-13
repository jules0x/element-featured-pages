<% if $ShowTitle %>
    <div class="title-wrap<% if $Constrain %> container<% end_if %>">
        <h2 class="title">$Title</h2>
    </div>
<% end_if %>

<div class="element-featured-pages width__{$Width} flex-wrap<% if $Constrain %> container<% end_if %>" id="e{$ID}">
    $Elements
</div>
