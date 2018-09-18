<template>
    <div class="comment" v-if="enabled">
        <div>
            <h3 class="comment-title" v-once> {{ author }}</h3> <button v-if="deletable" @click="deleteAction">X</button>
        </div>
        <div class="comment-text">
            <slot></slot>
        </div>
    </div>
</template>
<script>
    export default{
        props: {
            author:{
                default: ""
            },
            deletable: {
                default: false
            },
            delete_url:{
                default:null
            }
        },
        data: function(){
            return {
                enabled: true
            }
        },
        methods:{
            deleteAction: function(){
                axios.delete(this.delete_url).then((response)=>{
                    this.enabled=false;
                    alert("Comment deleted")
                    window.location.reload();
                    }).catch((err)=>{
                        alert("Some error occured")
                        console.log(err)
                    }
                )
            }
        }
    }
</script>
<style>
    div.comment{
        border: solid beige 2px;
        max-width: 200px;
    }

</style>