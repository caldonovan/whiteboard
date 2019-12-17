<template>
    <div>
        <h2>These are posts!</h2>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
            post: {
                id: "",
                title: "",
                body: "",
                user_id: "",
                created_at: "",
                updated_at: ""
            },
            post_id: "",
            pagination: [],
            edit: false
        };
    },
    mounted() {
        axios.get("{{ route ('api.posts.index') }}")
        .then(response => {
            console.log(response);
            this.posts = response.data;
        })
        .catch(response => {
            console.log(response);
        });
    }
};
</script>
