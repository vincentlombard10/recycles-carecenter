<template>
    <div class=" row" v-if="contacts.length">
        <div class="col-12">
            <div class="Address_Box">
                <template v-if="selectedContact">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-2">
                                <input type="text"
                                       :name="fieldsPrefix + '-name'"
                                       :value="selectedContact ? selectedContact.name : ''"
                                       class="form-control form-control-sm">
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <input type="text"
                                           :name="fieldsPrefix + '-address1'"
                                           :value="selectedContact ? selectedContact.address1 : ''"
                                           class="form-control form-control-sm">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <input type="text"
                                           :name="fieldsPrefix + '-address2'"
                                           :value="selectedContact ? selectedContact.address2 : ''"
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 mb-2">
                                    <input type="text"
                                           :name="fieldsPrefix + '-postalcode'"
                                           :value="selectedContact ? selectedContact.postalcode : ''"
                                           class="form-control form-control-sm">
                                </div>
                                <div class="col-lg-9 mb-2">
                                    <input type="text"
                                           :name="fieldsPrefix + '-city'"
                                           :value="selectedContact ? selectedContact.city : ''"
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                            <button
                                class="btn btn-sm btn-danger"
                                @click="selectedContact = null">Annuler</button>
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
                                        @click="selectedContact = contact">
                                        {{ contact.id }} <span class="fw-bold">{{ contact.name }}</span>
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
const searchTerm = ref('')
const contacts = ref([])
const filteredContacts = ref([])
const selectedContact = ref()
const fetchFilteredContacts = async () => {
    if (searchTerm.value.length < 5) {
        filteredContacts.value = []
    } else {
        filteredContacts.value = contacts.value.filter(
            contact =>
                contact.name.toLocaleLowerCase().includes(searchTerm.value.toLowerCase()) ||
                contact.id.toString().includes(searchTerm.value)
        )
    }
}
const fetchAllContacts = async () => {
    const req = await fetch('/contacts/search')
    const response = await req.json()
    contacts.value = response.contacts;
    console.log(contacts.value.length)
}

onMounted(() => {
    fetchAllContacts()
})

</script>

<style lang="scss" scoped>
.Address_Box {
    background-color: oklch(0.967 0.003 264.542);
    padding: 1.5rem 2rem;
}
.Contact_Selector {
    overflow-y: scroll;
    max-height: 12rem;
    border: 1Px solid black;
    border-radius: 0 0 0.25rem 0.25rem;

    .Contact_Item {
        padding: 0.65rem 1rem;
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
