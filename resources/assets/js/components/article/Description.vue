<template>
    <div class="">
        <br>
        <div v-if="event" style="padding-bottom: 30%; " v-html="event.description">
        </div>
    </div>
</template>

<script>
    export default {
        name: "Description",
        props: {
            id: null
        },
        data() {
            return {event: null}
        },
        mounted() {
            // console.log("umad " + this.id)
            this.fetchData(this.id);
        },
        methods: {
            fetchData(id) {
                var form = new FormData();
                form.append('id', id);
                axios.post('/getEventsById', form).then(response => {
                        this.event = response.data;
                        console.log(this.event);
                    }
                );
            }
        }
    }
</script>

<style scoped>
    .left_2 {
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid black;
        /* background: #5cebe6; */
    }
</style>