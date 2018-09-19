<template>
    <div class="user" v-if="enabled">
        <ol class="user-item" >
            <li class="user-item">
                <a :href="link">
                    {{name}} <span v-if="likes">( {{likes}} likes)</span>
                </a>
            </li>
            <li v-if="stil_subscribed != null" class="user-item">
                <button @click="subscribe" v-if="!stil_subscribed">
                    Subscribe
                </button>
                <button @click="unsubscribe" v-if="stil_subscribed">
                    Unsubscribe
                </button>
            </li>
            <li v-if="deletable" class="user-item">
                <button @click="deleteUser">
                    Delete
                </button>
            </li>
        </ol>
    </div>
</template>
<script>
    export default{
        props: {
            name: {
                default: ""
            },
            link: {
                default: ""
            },
            likes: {
                default: null
            },
            subscribed: {
                default: null
            },
            subscribe_url:{
                default: true
            },
            unsubscribe_url:{
                default: true
            },
            deletable: {
                default: false
            },
            delete_url: {
                default: false
            }
        },
        data: function(){
            return {
                enabled: true,
                is_updating: false,
                stil_subscribed: null,
            }
        },
        methods: {
            deleteUser : function(){
                if(this.is_updating) return;
                this.is_updating = true;
                var url = this.delete_url
                console.log('Sending request to ' + url)
                axios.delete(url).then((response)=>{
                   console.log(response)
                       this.enabled = false;
                    this.is_updating = false;
                    alert('User successfully deleted');
                }).catch((err)=>{
                    console.log(err);
                    alert('Couldn\'t delete user')
                    this.is_updating = false;
                });
            },
            subscribe : function(){
                if(this.is_updating) return;
                this.is_updating = true;
                var url = this.subscribe_url
                console.log('Sending request to ' + url)
                axios.post(url).then((response)=>{
                    console.log(response)
                    this.stil_subscribed = true;
                    this.is_updating = false;
                    alert('You successfully subscribed');
                }).catch((err)=>{
                    console.log(err);
                    alert('Couldn\'t subscribe')
                    this.is_updating = false;
                });
            },
            unsubscribe : function(){
                if(this.is_updating) return;
                this.is_updating = true;
                var url = this.unsubscribe_url
                console.log('Sending request to ' + url)
                axios.post(url).then((response)=>{
                    console.log(response)
                    this.stil_subscribed = false;
                    this.is_updating = false;
                    alert('You successfully unsubscribed');
                }).catch((err)=>{
                    console.log(err);
                    alert('Couldn\'t subscribe')
                    this.is_updating = false;
                });;
            },
        },
        mounted: function(){
            this.stil_subscribed = this.subscribed ? (this.subscribed == "true" ? true :false) : null;
        }
    }
</script>
<style>
    .user-item{
        display: inline;
    }
</style>