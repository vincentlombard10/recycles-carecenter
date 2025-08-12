<template>
    <div class=" row" v-if="contacts.length">
        <div class="col-12">
            <div class="Address_Box">
                <template v-if="selectedContact">
                    <div class="row">
                        <div class="col-12">
                            <div class="Address_Box__Contact">
                                <span class="fw-bold">{{ contactCode }}</span>
                                <div v-show="!formIsOpen">
                                    <div>{{ contactName }}</div>
                                    <div>{{ contactAddress1 }} - {{ contactAddress2 }}</div>
                                    <div>{{ contactPostalcode }} {{ contactCity }}</div>
                                    <div class="Actions">
                                        <a href="#" @click.prevent="openForm">Editer</a>
                                        <a href="#" class="text-danger" @click.prevent="selectedContact = null">Annuler</a>
                                    </div>
                                </div>
                                <div id="Address_Form" v-show="formIsOpen">
                                    <input type="hidden"
                                           :name="fieldsPrefix + '-code'"
                                           v-model="contactCode"
                                           :value="selectedContact ? selectedContact.code : ''">
                                    <div class="mb-3">
                                        {{ contactName }}
                                        <input type="text"
                                               :name="fieldsPrefix + '-name'"
                                               v-model="contactName"
                                               class="form-control"
                                               autocomplete="off">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <input type="text"
                                                   :name="fieldsPrefix + '-address1'"
                                                   v-model="contactAddress1"
                                                   class="form-control"
                                                   autocomplete="off">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <input type="text"
                                                   :name="fieldsPrefix + '-address2'"
                                                   v-model="contactAddress2"
                                                   class="form-control"
                                                   autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 mb-2">
                                            <input type="text"
                                                   :name="fieldsPrefix + '-postalcode'"
                                                   v-model="contactPostalcode"
                                                   class="form-control"
                                                   autocomplete="off">
                                        </div>
                                        <div class="col-lg-9 mb-2">
                                            <input type="text"
                                                   :name="fieldsPrefix + '-city'"
                                                   v-model="contactCity"
                                                   class="form-control"
                                                   autocomplete="off">
                                        </div>
                                    </div>
                                    <div>
                                        <a href="" @click.prevent="closeForm">Terminer</a>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" :name="fieldsPrefix + '-id'" />
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text"
                                   id="search"
                                   class="form-control"
                                   v-model="searchTerm"
                                   @input="fetchFilteredContacts"
                                   autocomplete="off"
                                   placeholder="Recherche par code client ou nom">
                        </div>
                        <div class="col-lg-6">
                            <div class="Contact_Selector" v-if="filteredContacts.length">
                                <ul>
                                    <li v-for="contact in filteredContacts"
                                        :key="contact"
                                        class="Contact_Item"
                                        @click="selectContact(contact)">
                                        {{ contact.code }} <span class="fw-bold">{{ contact.name }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>


<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps(['fieldsPrefix'])

const emit = defineEmits(["selected"])
const searchTerm = ref('')
const contacts = ref([])
const filteredContacts = ref([])
const selectedContact = ref()
const formIsOpen = ref(false)
const contactCode = ref('')
const contactName = ref('')
const contactAddress1 = ref('')
const contactAddress2 = ref('')
const contactPostalcode = ref('')
const contactCity = ref('')

const fetchFilteredContacts = async () => {
    if (searchTerm.value.length < 5) {
        filteredContacts.value = []
    } else {
        filteredContacts.value = contacts.value.filter(
            contact =>
                contact.name.toLocaleLowerCase().includes(searchTerm.value.toLowerCase()) ||
                contact.code.toString().includes(searchTerm.value)
        )
    }
}
const fetchAllContacts = async () => {
    const req = await fetch('/contacts/search')
    const response = await req.json()
    contacts.value = response.contacts;
    console.log(contacts.value.length)
}

const selectContact = (contact) => {
    selectedContact.value = contact
    contactCode.value = contact.code
    contactName.value = contact.name
    contactAddress1.value = contact.address1
    contactAddress2.value = contact.address2
    contactPostalcode.value = contact.postalcode
    contactCity.value = contact.city
    emit("selected", selectedContact.value)
}

const openForm = () => {
    document.querySelector('#Address_Form').classList.add('open');
    formIsOpen.value = true
}

const closeForm = () => {
    document.querySelector("#Address_Form").classList.remove('open');
    formIsOpen.value = false
}

onMounted(() => {
    fetchAllContacts()
})

</script>

<style lang="scss" scoped>
.Address_Box {
    &__Contact {
        background: oklch(94.3% 0.029 294.588);
        color: oklch(38% 0.189 293.745);
        padding: 0.75rem 1rem;
        border-radius: 0.15rem;
        .Actions {
            display: flex;
            justify-content: space-between;
        }
    }
    .form-control {
        border: 1px solid oklch(55.1% 0.027 264.364);
        background-color: white;
    }
    .address-form {
        display: none;
        &.open {
            display: block;
        }
    }
}
.Contact_Selector {
    overflow-y: scroll;
    max-height: 12rem;
    border-radius: 0 0 0.25rem 0.25rem;
    border: 1px solid oklch(70.4% 0.04 256.788);
    background-color: white;
    .Contact_Item {
        padding: 0.375rem 1rem;
        border-bottom: 1Px solid #b5babd;
        cursor: pointer;
        &:hover {
            background-color: black;
            color: white;
        }
        &:last-child {
            border-bottom: 0;
        }
    }
}
</style>
