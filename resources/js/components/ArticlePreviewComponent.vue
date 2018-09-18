<template>
    <div class="article-preview" @mouseenter="preview" @mouseleave="hide" style="max-width:40%;">
        <a :href="full_article_url" >
        <h2 class="article-preview-title">
            {{ title }}
            <span v-if="editable == 'true'">
                <a :href="edit_url">
                    <button>
                        Edit
                    </button>
                </a>
            </span>
        </h2>
        </a>
        <h3>
            <a :href="author_url">
            {{ author }}
            </a>
        </h3>
        <div class="article-preview-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default{
        props: {
            title: {
                default: ""
            },
            full_article_url: {
                default: ""
            },
            author:{
                default: ""
            },
            author_url:{
                default: "#"
            },
            edit_url:{
                default: '#'
            },
            editable: {
                default: ""
            }
        },
        data:function(){
            return {
                show: false
            }
        },
        methods:{
            preview: function(){
                this.show = true;
            },
            hide: function(){
                this.show = false;
            }
        }
    }
</script>
<style>
    div.article-preview{
        border: solid silver 1px;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }
    .article-preview-title{
        text-align: center;
    }
</style>