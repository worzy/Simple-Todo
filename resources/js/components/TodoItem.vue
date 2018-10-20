<template>
  <li>
    <input dusk="edit-todo-input" @keydown.enter="update" v-if="editing" v-model="todo.name">
    <span dusk="edit-todo" v-else @click="edit">{{ todo.name }}</span>
    <button dusk="remove-button" @click="$emit('remove', todo.id)">
      X
    </button>
  </li>
</template>

<script>
export default {
  props: {
    todo: {
      type: Object,
      required: true,
    }
  },
  data () {
    return {
      editing: false
    }
  },
  methods: {
    edit () {
      console.log(this);
      this.editing = true;
    },
    update(){
      this.editing = false;
        this.$parent.updateTodo(this.todo.id, this.todo.name);
    }
  }
}
</script>

<style lang="scss" scoped>
    .todos-list li {
        padding: 10px;
        &:hover {
          background-color: #e0e0e0;
        }
        button {
          float: right;
        }
    }
</style>