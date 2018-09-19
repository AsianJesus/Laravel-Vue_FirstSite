<template>
    <div class="article-preview" @mouseenter="preview" @mouseleave="hide" style="max-width:40%;">
        <a :href="full_article_url" >
        <h2 class="article-preview-title">
            {{ title }}
        </h2>
        </a>
        <span>
                <a :href="edit_url" v-if="editable=='true'">
                    <button>
                        Edit
                    </button>
                </a>
                <button v-if="deletable == 'true'" @click="del">
                    Delete
                </button>
        </span>
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
            },
            deletable:{
                default: ''
            },
            delete_url:{
                default: "#"
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
            },
            del: function(event){
                if(!confirm('Delete article?')){
                    event.preventDefault();
                    return;
                }
                else{
                    axios.delete(this.delete_url).then
                    ((response)=> {
                        alert("Successfully deleted article")
                        window.location.reload()
                    }).catch((response)=>{
                        alert("Couldn't delete the article")
                        console.log(err)
                        }

                    )

                }

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