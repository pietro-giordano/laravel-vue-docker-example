<script>
import axios from 'axios';

export default {
    name: 'UpdateTask',
    data() {
        return {
            task: [],
            successFlag: false,
            errorMessage: "",
            errorFlag: false,
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
        },

        updateTask() {
            axios
                .put('http://127.0.0.1:8000/api/tasks/' + this.$route.params.id, {
                    title: this.task.title, 
                    description: this.task.description,
                })
                .then(response => {
                    console.log(response.data);
                    this.successFlag = true;
                    this.errorFlag = false;
                })
                .catch((error) => {
                    console.error(error);
                    this.errorMessage = error.response.data.message;
                    this.successFlag = false;
                    this.errorFlag = true;
                });
        }
    },
    created() {
        this.getTask();
    } 
}
</script>

<template>
    <div class="container mt-3">

        <div v-if="successFlag" class="alert alert-success">
            Operazione avvenuta con successo
        </div>

        <div v-if="errorFlag" class="alert alert-danger">
            {{ errorMessage }}
        </div>

        <form @submit.prevent>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" v-model="task.title">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" v-model="task.description"></textarea>
            </div>

            <button @click="updateTask()" type="submit" class="btn btn-primary">Submit</button>
        </form>

        <router-link class="btn btn-primary mt-4" :to="{ name: 'homepage' }">
            Back
        </router-link>

    </div>
</template>

<style lang="scss" scoped></style>