<div class="storyContent">

<h3>{{ story.getTitle() }}</h3>
<div class="date">Created on {{ story.getDate() }}  by {{ story.getUser() }}</div>
<div class="storyText">{{ story.getText()|nl2br }}</div>
</div>