<template xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div class="add-comment">
        <form method="POST" :action="submit_url">
            <textarea name="text">
            </textarea>
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="uid" :value="user">
            <input type="hidden" name="article_id" :value="article">
            <input type="submit" value="Submit">
        </form>
    </div>
</template>
<script>
    export default{
        props: {
            user: {
                default: null
            },
            submit_url: {
                default: ""
            },
            csrf:{
                default: null
            },
            article:{
                default: null
            }
        },
        data: function(){
            return {
                comment: ""
            }
        },
        methods: {
            add: function(){
                axios.post(this.submit_url,{'uid':this.user,'text':this.comment,'_token':this.csrf}).then((response)=>{
                    alert('Successfully added')
                }).catch((err)=>{
                    alert('It didn\'t work');
                    console.log(err)
                });
            }
        }
    }
</script>