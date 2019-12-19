<template>
    <div>
        <form class="mb-3">
            <div class="form-group">
                <textarea class="form-control" placeholder="Post a new comment..." name="comment_body" id="editor" v-model="comment_body"></textarea>
            </div>
            <button class="btn btn-primary" @click.prevent="createComment">Submit</button>
        </form>
        <div v-for="comment in comments" v-bind:key="comment.id" v-bind:id="comment.id">
            <p><b>{{ comment.user_name }}</b> | <small>{{ comment.updated_at }}</small></p>
            <p>{{ comment.body }}</p>
            <button v-if="user_id == comment.user_id" @click.prevent="editComment(comment)" class="btn btn-sm btn-deep-orange">
                <svg class="bi bi-pencil" width="2.5em" height="2.5em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M13.293 3.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM14 4l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"></path>
                    <path fill-rule="evenodd" d="M14.146 8.354l-2.5-2.5.708-.708 2.5 2.5-.708.708zM5 12v.5a.5.5 0 00.5.5H6v.5a.5.5 0 00.5.5H7v.5a.5.5 0 00.5.5H8v-1.5a.5.5 0 00-.5-.5H7v-.5a.5.5 0 00-.5-.5H5z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <button v-if="user_id == comment.user_id" @click.prevent="deleteComment(comment.id)" class="btn btn-sm btn-danger">
                <svg class="bi bi-trash-fill" width="2.5em" height="2.5em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.5 3a1 1 0 00-1 1v1a1 1 0 001 1H5v9a2 2 0 002 2h6a2 2 0 002-2V6h.5a1 1 0 001-1V4a1 1 0 00-1-1H12a1 1 0 00-1-1H9a1 1 0 00-1 1H4.5zm3 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5zM10 7a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 0110 7zm3 .5a.5.5 0 00-1 0v7a.5.5 0 001 0v-7z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <hr>
        </div>
    </div>
</template>

<script>
$(() => {
    NProgress.start();
})

export default {
    props: ['postId', 'bearerToken', 'userId'],
    data() {
        return {    
            comments: [],
            comment_id: '',
            comment_body: '',   
            user_id: this.userId,
            edit: false
        };
    },
    mounted() {
        this.fetchComments()
    },
    updated() {
        this.$nextTick(() => {
            NProgress.done();
            console.log("Done Loading!");
        })  
    },
    methods: {
        fetchComments() {
            console.log(this.user_id);
            axios.get(route('api.comments.show', {post_id: this.postId}))
            .then(response => {
                console.log(response.data);
                this.comments = response.data;
            })
            .catch(error => {
                console.log(error);
            })
        },
        createComment() {
            NProgress.start();
            console.log(this.bearerToken);
            if(this.edit == false) {
                axios.post(route('api.comments.store'), {
                    api_token: this.bearerToken,
                    post_id: this.postId,
                    body: this.comment_body
                })
                .then(response => {
                    this.comments.push(response.data);
                    this.comment_body = '';
                 })
                .catch(error => {
                    console.log(error);
                })
                NProgress.done();
            } else {
                axios.put(route('api.comments.update', {id: this.comment_id}), {
                    api_token: this.bearerToken,
                    post_id: this.postId,
                    body: this.comment_body
                })
                .then(response => {
                    console.log("Comment Updated!");
                    this.edit = false;
                    this.comment_body = '',
                    this.comment_id= '',
                    this.fetchComments();
                })
                .catch(error => {
                    console.log(error);
                })
            }
            
        },
        deleteComment(id) {
            NProgress.start();
            const token = this.bearerToken;
            console.log(id);
            axios.delete(route('api.comments.delete', {id: id}), {
                params: {
                    'id': id,
                },
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
            .then(response => {
                console.log("Delete successful!");
                this.fetchComments();
            })
            .catch(error => {
                console.log(error);
            })
        },
        editComment(comment) {
            console.log(this.bearerToken + this.user_id + this.comment_body + this.comment_id);
            this.edit = true;
            this.comment_id = comment.id;
            this.comment_body = comment.body;
        },
        updateComment() {
            // Update comment after edit
        }
    }
};
</script>
