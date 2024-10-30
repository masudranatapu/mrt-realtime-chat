<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Chat with {{ user?.name }} id= {{ user?.id }}
                    </div>
                    <div class="card-body">
                        <ul class="list-group chat-messages">
                            <li v-for="(mymsg, index) in messages">
                                <span v-if="mymsg.sender_id === auth.id">
                                    <strong>{{ auth.name }}</strong
                                    >: {{ mymsg.message }}
                                </span>
                                <span v-else>
                                    <strong>{{ mymsg.sender?.name }}</strong
                                    >: {{ mymsg.message }}
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <form @submit.prevent="sendMessage">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="newMessage"
                                    placeholder="Type a message..."
                                />
                                <button class="btn btn-primary" type="submit">
                                    Send
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'
export default {
    props: ['user', 'auth'],
    data () {
        return {
            messages: [],
            newMessage: ''
        }
    },
    mounted () {
        this.loadMessages()

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '38d82df52ac4fcbd4f9a',
            cluster: 'ap2',
            encrypted: true,
        })

        window.Echo.channel(`chat.${this.user.id}`).listen('MessageEvent', (e) => {
            this.messages.push(e.message);
        });

        Pusher.logToConsole = true;

    },
    methods: {
        loadMessages () {
            axios.get(`/chat/${this.user?.id}/messages`).then(response => {
                this.messages = response.data.chat
            })
        },
        sendMessage () {
            axios.post('/chat-sent', {
                receiver_id: this.user?.id,
                message: this.newMessage
            }).then(() => {
                this.messages.push({
                    message: this.newMessage,
                    sender_id: this.auth.id
                })
                this.newMessage = ''
            })
        }
    }
}
</script>

<style scoped>
.chat-messages {
    max-height: 300px;
    overflow-y: auto;
    margin-bottom: 15px;
}

.list-group-item {
    border: none;
    padding: 10px 15px;
    margin-bottom: 5px;
}

.card-footer {
    padding-top: 10px;
}
</style>
