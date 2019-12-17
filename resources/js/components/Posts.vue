<template>
    <div>
        <div class="card card-body mb-3" v-for="post in posts" v-bind:key="post.id">
            <h3>{{ post.title }}</h3>
            <p>{{ post.body }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {    
            posts: [],
            pagination: [],
            edit: false
        };
    },
    mounted() {
        axios.get(route('api.posts.index'))
        .then(response => {
            console.log(response.data);
            this.posts = response.data;
        })
        .catch(response => {
            console.log(response);
        })
    }
};
</script>
