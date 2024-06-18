<script>
import axios from 'axios';

export default {
    name: 'Homepage',
    data() {
        return {
            tasks: [],
            successFlag: false,
        }
    },
    methods: {
        getTasks() {
            axios
                .get('http://127.0.0.1:8000/api/tasks')
                .then(response => {
                    console.log(response.data);
                    this.tasks = response.data.tasks;
                })
                .catch(error => {
                    console.error(error);
                });
        },

        deleteTask(id) {
            axios
                .delete('http://127.0.0.1:8000/api/tasks/' + id) 
                .then(response => {
                    console.log(response.data);
                    console.log('Task ' + id + ' eliminato');
                    this.successFlag = true;

                    // richiamo index per aggiornare lista di tutti i tasks
                    this.getTasks();
                })
                .catch(error => {
                    console.error(error);
                });
        }
    },
    created() {
        this.getTasks();
    } 
}
</script>

<template>
    <div class="container mt-3">

        <router-link class="btn btn-primary my-3" :to="{ name: 'create' }">
            Create new task
        </router-link>

        <div v-if="successFlag" class="alert alert-success">
            Operazione avvenuta con successo
        </div>

        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="task in tasks">
                    <td>{{ task.id }}</td>
                    <td>{{ task.title }}</td>
                    <td>{{ task.description }}</td>
                    <td class="d-flex">
                        <router-link class="btn btn-info me-2" :to="{ name: 'show', params: { id: task.id } }">
                            Show
                        </router-link>

                        <router-link class="btn btn-warning me-2" :to="{ name: 'update', params: { id: task.id } }">
                            Update
                        </router-link>

                        <button class="btn btn-danger" @click="deleteTask(task.id)">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<style lang="scss" scoped></style>