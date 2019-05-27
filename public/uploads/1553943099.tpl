           
            <section class="gp-post-item  post type-post status-publish format-standard has-post-thumbnail category-entertainment category-featured-slider tag-boat tag-group tag-random" itemscope="" itemtype="#">

<input type="hidden" class="Get1" id="{$pcat['p_id']}">
              <div class="gp-post-thumbnail gp-loop-featured">
            
                <div class="gp-image-above">                 
                 {if $pcat['source']!="" && $pcat['post_type'] == 'photos'}
                 <a href="{$system['system_url']}/photos/{$pcat['photo_id']}" class="js_lightbox" data-id="{$pcat['photo_id']}" data-image="{$system['system_uploads']}/{$pcat['source']}" data-context="{if $photo['is_single']}album{else}post{/if}" title="">
                 <img src="{$system['system_url']}/content/uploads/{$pcat['source']}" class="gp-post-image gp-large-image"> </a>


{elseif $pcat['post_type'] == "video" && $pcat['source1']!=""}
   <div>
        <video width="100%" class="js_mediaelementplayer" controls="controls" preload="auto">
            <source src="{$system['system_uploads']}/{$pcat['source1']}" type="video/mp4">
            <source src="{$system['system_uploads']}/{$pcat['source1']}" type="video/webm">
        </video>
</div>


{elseif $pcat['post_type'] == "audio" && $pcat['sourceA']!=""}
<div>
        <audio width="100%" class="js_mediaelementplayer">
            <source src="{$system['system_uploads']}/{$pcat['sourceA']}">
            {__("Your browser does not support HTML5 audio")}
        </audio>
    </div>

{elseif $pcat['post_type'] == "file" && $pcat['sourcef']!==""}

    <div class="post-downloader">
        <div class="icon">
            <i class="fa fa-file-text-o fa-2x"></i>
        </div>
        <div class="info">
            <strong>{__("File Type")}</strong>: {get_extension({$pcat['sourcef']})}
            <div class="mt10">
                <a class="btn btn-primary btn-sm" href="{$system['system_uploads']}/{$pcat['sourcef']}">{__("Download")}</a>
            </div>
        </div>
    </div>

{elseif $pcat['post_type'] == "media"}
<div class="mt10">
        {if $pcat['source_type'] == "photo"}
            <div class="post-media">
                <div class="post-media-image">
                    <div style="background-image:url('{$pcat['source_url']}');"></div>
                </div>
                <div class="post-media-meta">
                    <div class="source"><a target="_blank" href="{$pcat['source_url']}">{$pcat['source_provider']}</a></div>
                </div>
            </div>
         {else}
            {if $pcat['source_provider'] == "YouTube"}
                {if $system['smart_yt_player']}
                    {$pcat['vidoe_id'] = get_youtube_id($pcat['source_html'])}
                    <div class="youtube-player" data-id="{$pcat['vidoe_id']}">
                        <img src="https://i.ytimg.com/vi/{$pcat['vidoe_id']}/hqdefault.jpg">
                        <div class="play"></div>
                    </div>
                {else}
                
                    <div class="post-media">
                        <div class="embed-responsive embed-responsive-16by9">
                            {html_entity_decode($pcat['source_html'], ENT_QUOTES)}
                        </div>
                    </div>
                    <div class="post-media-meta">
                        <a class="title mb5" href="{$pcat['source_url']}" target="_blank">{$pcat['source_title']} 
                           </a>
                        <div class="text mb5">{$pcat['source_text']}</div>
                        <div class="source">{$pcat['source_provider']}</div>
                    </div>
                {/if}
               {elseif $pcat['source_provider'] == "Vimeo" || $pcat['source_provider'] == "SoundCloud" || $pcat['source_provider'] == "Vine"}
                <div class="post-media">
                    <div class="embed-responsive embed-responsive-16by9">
                        {html_entity_decode($pcat['source_html'], ENT_QUOTES)}
                    </div>
                </div>
                <div class="post-media-meta">
                    <a class="title mb5" href="{$pcat['source_url']}" target="_blank">{$pcat['source_title']}</a>
                    <div class="text mb5">{$pcat['source_text']}</div>
                    <div class="source">{$pcat['source_provider']}</div>
                </div>
            {else}
                <div class="embed-ifram-wrapper">
                    {html_entity_decode($pcat['source_html'], ENT_QUOTES)}
                </div>
            {/if}
{/if}        
    </div>

{elseif $pcat['post_type'] == "poll"}
    <div class="poll-options mt10" data-poll-votes="{$pcat['votes']}">       
            <div class="mb5">
                <div class="poll-option js_poll-vote" data-id="{$pcat['option_id']}" data-option-votes="{$pcat['votes']}">
                    <div class="percentage-bg" {if $pcat['votes'] > 0} style="width: {($pcat['votes']/$pcat['votes'])*100}%"{/if}></div>
                    <div class="radio radio-primary radio-inline">
                        <input type="radio" name="poll_{$pcat['poll_id']}" id="option_{$pcat['option_id']}" {if $pcat['checked']}checked{/if}>
                        <label for="option_{$pcat['option_id']}">{$pcat['text']}</label>
                    </div>
                </div>
                <div class="poll-voters">
                    <div class="more" data-toggle="modal" data-url="posts/who_votes.php?option_id={$pcat['option_id']}">
                        {$pcat['votes']}
                    </div>
                </div>
            </div>        
    </div>


{elseif $pcat['post_type'] == "link"}
    <div class="mt10">
        <div class="post-media">
            {if $pcat['source_thumbnail']}
                <!--div class="post-media-image">
                    <div style="background-image:url('{$pcat['source_thumbnail']}');"></div>
                </div-->
                <a  href="javascript:void(0);" class="js_lightbox" data-id="{$pcat['p_id']}" data-image="{$pcat['source_thumbnail']}" data-context="nothing" title="">
                 <img src="{$pcat['source_thumbnail']}" class="gp-post-image gp-large-image"> </a>
            {/if}
            <div class="post-media-meta">
                <a class="title mb5" href="{$pcat['source_url']}" target="_blank">{$pcat['source_title']}</a>
                <div class="text mb5">{$pcat['source_text']}</div>
                <div class="source">{$pcat['source_host']|upper}</div>
            </div>
        </div>
    </div>

{elseif $pcat['post_type'] == "article"}
    <div class="mt10">
        <div class="post-media">
            {if $pcat['article']['cover']}
                <a class="post-media-image" href="{$system['system_url']}/blogs/{$pcat['post_id']}/{$pcat['title_url']}">
                    <div style="padding-top: 50%; background-image:url('{$system['system_uploads']}/{$pcat['cover']}');"></div>
                </a>
            {/if}
            <div class="post-media-meta">
                <a class="title mb5" href="{$system['system_url']}/blogs/{$pcat['post_id']}/{$pcat['title_url']}">{$pcat['title']}</a>
                <div class="text mb5">{$pcat['text_snippet']|truncate:400}</div>
            </div>
        </div>
    </div>
                 

                 {else}
                 <a href="javascript:void(0)" class="js_lightbox" data-type=""  data-src="{$system['system_url']}/content/uploads/{$pcat['category_image']}" data-image="{$system['system_url']}/content/uploads/{$pcat['category_image']}" data-context="nothing" data-id="{$pcat['p_id']}">
	<img src="{$system['system_url']}/content/uploads/{$pcat['category_image']}" class="gp-post-image gp-large-image" alt="">
    </a>




    		{/if}
			   </div>
































       
              </div>
              <div class="gp-loop-content gp-image-above">

                <div class="gp-loop-cats"><a href="#">{$pcat['feeling_value']}</a><a href="saved-post.html" class="bg-saved-post pull-right"></a></div>            
            
              	{if $url_id != 10}

                <input type="hidden" name="post_id" value="{$pcat['p_id']}" class="Savepost2">
                
                    {if $_post['i_save'] || $pcat['status']=='yes' && $pcat['user_id'] == $user->_data['user_id']}
 
                        <a href="javascript:void(0)" class="js_unsave-post" id="Savepost2" for="{$pcat['p_id']}">
                            <div class="action no-desc">
                                <i class="fa fa-bookmark fa-fw"></i> <span>{__("Unsave")}</span>
                            </div>
                        </a>                        
                    {else}                    
                        <a href="javascript:void(0)" class="js_save-post pull-right" id="Savepost2" for="{$pcat['p_id']}">
                            <div class="action no-desc">
                                <i class="fa fa-bookmark fa-fw"></i> <span>{__("Save")}</span>
                            </div>
                        </a>
                        
                    {/if}
                    
                {/if}
                
                {if $pcat['source']!="" }
                    <a href="javascript:void(0)"  class="js_lightbox" data-type="{$pcat['post_type']}" data-src="{$system['system_uploads']}/{$pcat['source']}" data-id="{$pcat['photo_id']}" data-image="{$system['system_uploads']}/{$pcat['source']}" data-context="{if $photo['is_single']}album{else}post{/if}" >
                            <div class="action no-desc">
                                <i class="fa fa-bookmark fa-fw"></i> <span>{__("Comment")}</span>
                            </div>
                        </a>
                    {else}
                     <a href="javascript:void(0)" class="js_lightbox" {if $pcat['source_provider'] == "YouTube"} data-src="{$pcat['vidoe_id']}" data-type="youtube" {elseif $pcat['post_type'] == "audio" } data-type="audio" data-src="{$system['system_uploads']}/{$pcat['sourceA']}" {elseif $pcat['post_type'] == "file"} data-src="{$system['system_uploads']}/{$pcat['sourcef']}" data-type="file" {else} data-type="{$pcat['post_type']}" {/if} {if $pcat['post_type']== 'video' && $pcat['source1'] != null} data-src="{$system['system_uploads']}/{$pcat['source1']}" {/if} data-image="{$system['system_url']}/content/uploads/{$pcat['category_image']}" data-context="nothing" data-id="{$pcat['p_id']}">
                            <div class="action no-desc">
                                <i class="fa fa-bookmark fa-fw"></i> <span>{__("Comment")}</span>
                            </div>
                        </a>
                    {/if}
                
                <div class="pos-rel">
                    <a href="javascript:void(0)" class="tag-btn-c2 dont-sh js_lightbox"
                    {if $pcat['source']!="" }
                    data-type="{$pcat['post_type']}" data-src="{$system['system_uploads']}/{$pcat['source']}" data-id="{$pcat['photo_id']}" data-image="{$system['system_uploads']}/{$pcat['source']}" data-context="{if $photo['is_single']}album{else}post{/if}"
                    {else if $pcat['source_thumbnail']}
                    data-id="{$pcat['p_id']}" data-image="{$pcat['source_thumbnail']}" data-context="nothing" title=""
                    {else}
                   {if $pcat['source_provider'] == "YouTube"} data-src="{$pcat['vidoe_id']}" data-type="youtube" {elseif $pcat['post_type'] == "audio" } data-type="audio" data-src="{$system['system_uploads']}/{$pcat['sourceA']}" {elseif $pcat['post_type'] == "file"} data-src="{$system['system_uploads']}/{$pcat['sourcef']}" data-type="file"  {else} data-type="{$pcat['post_type']}" {/if} {if $pcat['post_type']== 'video' && $pcat['source1'] != null} data-src="{$system['system_uploads']}/{$pcat['source1']}" {/if} data-image="{$system['system_url']}/content/uploads/{$pcat['category_image']}" data-context="nothing" data-id="{$pcat['p_id']}"
                    {/if}
                    > <!--onclick="openpopup({$pcat['p_id']})"-->
                   <h2 class="gp-loop-title CategoryPost">
                {$pcat['text_post']}
                <!-- </a> -->
                </h2></a>
                
                 <div class="pos-nw-home2 tag-s-v2 opo{$pcat['p_id']} hidediv" id="hide" style="display:none;">
				<a href="javascript:void(0)" class="tag-btn-c2 dont-sh cls-icn-tool"> <i class="fa fa-close"></i> </a>
								<div class="scrollbar" id="style-2" >
								<p id="Htext"> {$pcat['text_post']}
									</p>
								</div>
							</div>
						
					</div>
                <div class="gp-loop-meta"> <span class="gp-post-meta gp-meta-author"><a href="{$system['system_url']}/{$pcat['user_name']}">{$pcat['user_name']} {$pcat['user_lastname']}</a></span>
                  <time class="gp-post-meta gp-meta-date" itemprop="datePublished" datetime="2017-10-07T14:22:07+00:00">{date("M-d-Y",strtotime($pcat['creater']))}</time>
                   <!--span class="gp-post-meta gp-meta-comments  text-clickable comment js_comments-toggle">{$pcat['comment']} comment</span--> 
                   
                   <!-- <span class="gp-post-meta gp-meta-views">5341 views</span> -->
                   </div> 
                <!-- <div class="gp-loop-text">
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text...</p>
                </div> -->
              </div>
            </section>         
			  
	  
	 


			


