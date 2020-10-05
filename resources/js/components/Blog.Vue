<template>
    <!-- <h1>Blog Vue</h1> -->
        <table class="table table-hover table-bordered">
            <thead>
            </thead>
                <tr v-for="blog in blogs.data" :key="blog.id">
                    <td>{{blog.id}}</td>
                </tr>
            </table>
</template>
<script>
    export default{
        data(){
            return{
                blogs   :{},
            }
        },

        methods: {
            loadBlogs(){
                // if(this.$gate.isAdminORAuthor()){
                  axios.get("api/blog").then(({ data }) => (this.blogs = data));
                // }
                
            },
        }
    }
</script>