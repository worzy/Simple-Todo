<template>
  <li>
    <input @keydown.enter="update" v-if="editing" v-model="todo.name">
    <span v-else @click="edit">{{ todo.name }}</span>
    <button @click="$emit('remove', todo.id)">
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