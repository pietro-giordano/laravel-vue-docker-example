<script>
import axios from 'axios';

export default {
    name: 'CreateTask',
    data() {
        return {
            newTask: {
                title: "",
                description: "",
            },
            successFlag: false,
            errorMessage: "",
            errorFlag: false,
        }
    },
    methods: {
        createTask() {
            axios
                .post('http://127.0.0.1:8000/api/tasks', {
                    title: this.newTask.title, 
                    description: this.newTask.description,
                })
                .then(response => {
                    console.log(response.data);
                    this.successFlag = true;
                    this.errorFlag = false;
                })
                .catch((error) => {
                    console.log(error);
                    this.errorMessage = error.response.data.message;
                    this.successFlag = false;
                    this.errorFlag = true;
                });
        }
    },
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
                <input type="text" class="form-control" id="title" v-model="newTask.title">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" v-model="newTask.description"></textarea>
            </div>

            <button @click="createTask()" type="submit" class="btn btn-primary">Submit</button>
        </form>

        <router-link class="btn btn-primary mt-4" :to="{ name: 'homepage' }">
            Back
        </router-link>

    </div>
</template>

<style lang="scss" scoped></style>