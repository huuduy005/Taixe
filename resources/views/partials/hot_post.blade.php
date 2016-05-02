@if(isset($hot_post))
    <div id="cloud" class="host_post pull-right">
        {{ link_to_action('TintucsController@show', $hot_post->tieude, $hot_post->id) }}
    </div>
@endif