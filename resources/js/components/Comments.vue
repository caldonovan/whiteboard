<template>
    <div>
        <form class="mb-3">
            <div class="form-group">
                <textarea class="form-control" name="commentBody" id="editor" v-model="newCommentBody"></textarea>
            </div>
            <button class="btn btn-primary" @click.prevent="createComment">Submit</button>
        </form>
        <div v-for="comment in comments" v-bind:key="comment.id">
            <p><b>{{ comment.user_name }}</b> | <small>{{ comment.created_at }}</small></p>
            <p>{{ comment.body }}</p>
            <hr>
        </div>
    </div>
</template>

<script>
$(() => {
    NProgress.start();
})

export default {
    props: ['postId', 'bearerToken'],
    data() {
        return {    
            comments: [],
            newCommentBody: '',
            edit: false
        };
    },
    mounted() {
        axios.get(route('api.comments.show', {post_id: this.postId}))
        .then(response => {
            console.log(response.data);
            this.comments = response.data;
        })
        .catch(error => {
            console.log(error);
        })
    },
    updated() {
        this.$nextTick(() => {
            NProgress.done();
            console.log("Done Loading!");
        })  
    },
    methods: {
        createComment() {
            NProgress.start();
            console.log(this.bearerToken);
            axios.post(route('api.comments.store'), {
                api_token: this.bearerToken,
                post_id: this.postId,
                body: this.newCommentBody
            })
            .then(response => {
                this.comments.push(response.data);
                this.newCommentBody = '';
            })
            .catch(error => {
                console.log(error);
            })
            NProgress.stop();
        }
    }
};
</script>
