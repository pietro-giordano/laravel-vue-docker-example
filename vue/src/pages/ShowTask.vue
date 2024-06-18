<script>
import axios from 'axios';

export default {
    name: 'ShowTask',
    data() {
        return {
            task: [],
        }
    },
    methods: {
        getTask() {
            axios
                .get('http://127.0.0.1:8000/api/tasks/' + this.$route.params.id)
                .then(response => {
                    console.log(response.data);
                    this.task = response.data.task;
                })
        }
    },
    created() {
        this.getTask();
    } 
}
</script>

<template>
    <div class="container mt-3">

        <h2>{{ task.title }}</h2>

        <p>{{ task.description }}</p>

        <router-link class="btn btn-primary mt-4" :to="{ name: 'homepage' }">
            Back
        </router-link>

    </div>
</template>

<style lang="scss" scoped></style>