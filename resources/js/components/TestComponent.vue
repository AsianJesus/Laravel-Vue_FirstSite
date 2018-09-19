<template>
    <div class="container">
        <p>
            <button @click='update' v-if='!isUpdating'>Test component</button>
            <span v-if='isUpdating'>Updating...</span>
        </p>
        <div class='result>' v-html='html'>

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: function(){
            return {
                html: "<h2>It works</h2>",
                isUpdating: false,
            }
        },
        methods:{
            update: function(){
                console.log('Started to update')
                this.isUpdating = true;
                app = this;
                axios.post('/monitor',{'type':'Elvin'}).then(function(response){
                    app.html = response.data;
                    console.log(response)
                    app.isUpdating = false;
                })
            }
        }
    }
</script>
