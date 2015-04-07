<h2>Last stories</h2>
{%  for item in stories %}
<div class="story">
    {{ link_to('story/view/'~item.getId(), item.getTitle()) }}
    <div class="resume">
        {{ item.getText()|cutWithWords(100, '...') }}
    </div>
</div>
{%  else %}
<p>No stories so far</p>
{%  endfor %}