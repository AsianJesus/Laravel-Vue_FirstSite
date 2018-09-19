<template>
    <div class='article'>
        <h1 class='article-title'> {{title}} </h1>
        <h2 class='article-author'> <a :href='user_url'>Author: {{user}}</a></h2>
        <div class='article-body'>
            <slot ></slot>
        </div>
    </div>
</template>
<script>
    export default{
        props:[
            'title',
            'user',
            'user_url'
        ]
    }
</script>
<style>

    .article-title{
        text-align: center;
    }
    .article-body{
        text-align: justify;
    }
</style>