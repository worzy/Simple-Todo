<template>
    <div class="container">
      <div>
        <BaseInputText 
            v-model="newTodoText"
            placeholder="New todo"
            @keydown.enter="addTodo"
        />
        <ul v-if="todos.length">
            <TodoListItem
                v-for="todo in sortedTodos"
                :key="todo.id"
                :todo="todo"
                @remove="removeTodo"
                @update="updateTodo"
            />
        </ul>
        <p v-else>
            You're all done.  Nothing left to do!
        </p>
    </div>
  </div>
</template>

<script>
import BaseInputText from './BaseInputText.vue'
import TodoListItem from './TodoItem.vue'

export default {
    components: {
        BaseInputText, TodoListItem
    },
  data () {
    return {
        newTodoText: '',
        todos: []
    }
  },
  mounted () {
    axios
        .get('/todos')
        .then(response => (this.todos = response.data))
  },
  computed: {
    sortedTodos() {
         return _.orderBy(this.todos, 'created_at', 'desc')
    }
  },
    methods: {
        addTodo () {
            const trimmedText = this.newTodoText.trim()
            if (trimmedText) {

                axios
                .post(`/todos`, {
                    name: trimmedText
                })
                .then(response => {
                    console.log(response);
                    this.todos.push({
                        id: response.data.id,
                        name: response.data.name
                    })
                    this.newTodoText = ''
                })
            }
        },
        updateTodo (id, text) {
            const trimmedText = text.trim()
            axios
            .put(`/todos/${id}`, {
                name: trimmedText
            })
            .then(response => {
                axios
                .get('/todos')
                .then(response => (this.todos = response.data))
            })
        },
        removeTodo (id) {
            axios
            .delete(`/todos/${id}`)
            .then(response => {
                this.todos = this.todos.filter(todo => {
                    return todo.id !== id
                })
            })
        }
    }
}
</script>