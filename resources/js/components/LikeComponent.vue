<template>
    <div class="like-component">
        <span v-if='!is_updating'>
            <span class='like-count'>Likes: {{ likes }}</span>
            <button v-if='!is_liked' class='like' @click='like'>Like</button>
            <button v-if='is_liked' class='dislike' @click='dislike'>Dislike</button>
        </span>
        <span v-if='is_updating'>Wait for second...</span>
    </div>
</template>

<script>
    export default{
        props: {
            liked: {
                default: false
            },
            like_count: {
                default: 0
            },
            like_url:{
                default: null
            },
            dislike_url:{
                default: null
            }
        },
        data: function(){
            return {
                is_liked: false,
                is_updating: false,
                likes: 0
            }
        },
        methods: {
            like: function(){
                if(this.is_updating) return;
                this.is_updating = true;
                var url = this.like_url
                console.log('Sending request to ' + url)
                axios.post(url).then((response)=>{
                        console.log(response)
                        this.is_liked = true;
                        this.is_updating = false;
                        console.log(response.data)
                        alert('You liked that');
                        this.likes += 1
                }).catch((err)=>{
                    console.log(err);
                    alert('Couldn\'t like')
                    this.is_updating = false;
                    console.log(this.is_liked);
                    this.is_liked = true;
                    console.log(this.is_liked);
                 });
            },
            dislike: function(){
                if(this.is_updating) return;
                this.is_updating = true;
                var url = this.dislike_url
                console.log('Sending request to ' + url)
                axios.delete(url).then((response)=>{
                        console.log(response)
                        this.is_liked = false;
                        console.log(response.data)
                        this.is_updating = false;
                        alert('You disliked that');
                        this.likes -= 1
                }).catch((err)=>{
                        console.log(err);
                        alert('Couldn\'t dislike')
                        this.is_liked = false;
                        this.is_updating = false;
                 });
            },
        },
        mounted(){
          this.is_liked = this.liked == 'true' || this.liked == '1' || this.liked == 1 ? true : false;
          this.likes = this.like_count;
          console.log(this.is_liked);
          console.log(this.likes);
        }
    }
</script>

<style>
    button.like{
        color: red;
    }
    button.dislike{
        color: blue;
    }
</style>