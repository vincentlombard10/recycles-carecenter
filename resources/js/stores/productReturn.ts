import {defineStore} from "pinia";
import {computed, ref} from "vue";

export const useProductReturnStore = defineStore('productReturn', () => {

    const generalMinSearchLength = ref<number>(3)
    const status = ref<string>('')
    /* Section 1 - Qualification */
    const type = ref<string>('')

    const typesOptions = [
        {identifier: "battery", label: "Batterie"},
        {identifier: "component", label: "Composant"},
        {identifier: "bike", label: "Vélo"},
    ]

    const setType = (_value: string) => {
        type.value = _value
    }

    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    const context = ref<string>('')

    const contextsOptions = [
        {identifier: "garantie", label: "Garantie"},
        {identifier: "hors_garantie", label: "Hors garantie"}
    ]

    const setContext = (_value: string) => {
        context.value = _value
    }

    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    const reason = ref<string>('')

    const setReason = (_value: string) => {
        reason.value = _value
    }

    const reasonsOptions = [
        {identifier: "erreur_client", label: "Erreur client"},
        {identifier: "erreur_interne", label: "Erreur interne"},
        {identifier: "panne_electrique", label: "Panne électrique"},
        {identifier: "panne_mecanique", label: "Panne mécanique"},
        {identifier: "velo_pret", label: "Vélo de prêt"},
        {identifier: "velo_salon", label: "Vélo salon"},
        {identifier: "geste_commercial", label: "Geste commercial"},
        {identifier: "casse", label: "Casse"},
    ]

    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    const assignation = ref<string>('')

    const assignationsOptions = [
        {identifier: "laboratoire", label: "Laboratoire"},
        {identifier: "qualite", label: "Qualité"},
        {identifier: "atelier", label: "Atelier"},
        {identifier: "stock", label: "Stock"},
    ]

    const setAssignation = (_value: string) => {
        assignation.value = _value
    }

    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    const action = ref<string>('')

    const actionsOptions = [
        {identifier: 'expertise_reparation', label: 'Expertise avec réparation'},
        {identifier: 'expertise_echange', label: 'Expertise avec échange'},
        {identifier: 'expertise_credit', label: 'Expertise avec crédit'},
        {identifier: 'expertise_seule', label: 'Expertise seule'},
    ]

    const setAction = (_value: string) => {
        action.value = _value
    }


    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    const destination = ref<string>('')

    const destinationsOptions = [
        {identifier: 'reexpedition', label: 'Réexpédition'},
        {identifier: 'reconditionnement', label: 'Reconditionnement'},
        {identifier: 'seconde_vie', label: 'Seconde vie'},
        {identifier: 'recyclage', label: 'Recyclage'},
    ]

    const setDestination = (_value: string) => {
        destination.value = _value
    }

    /*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    /* Section 2 - Ticket */

    const ticket = ref()
    const ticketSearchTerm = ref('')
    const ticketsList = ref([])

    const fetchTickets = async () => {
        const req = await fetch('/api/v1/tickets/?' + new URLSearchParams({q: ticketSearchTerm.value}))
        const response = await req.json()
        ticketsList.value = response.data
    }

    const setTicket = async (_ticket) => {
        const req = await fetch('/api/v1/tickets/?' + new URLSearchParams({q: _ticket}))
        const response = await req.json()
        ticket.value = response.data[0]
    }

    const cancelTicket = () => {
        ticket.value = null
        ticketSearchTerm.value = ''
        ticketsList.value = []
    }

    /*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    /* Section 4 - Informations de vente */

    const bikeSoldAt = ref<string>('')
    const order = ref<string>('')
    const invoice = ref<string>('')
    const delivery = ref<string>('')

    /*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    /* Section 5 - Commentaires */

    const info = ref<string>('')
    const note = ref<string>('')

    const item = ref()
    const itemsList = ref([])
    const itemSearchTerm = ref<string>('')


    const fetchItems = async () => {
        const req = await fetch('/api/v1/items/?' + new URLSearchParams({q: itemSearchTerm.value}))
        const response = await req.json()
        itemsList.value = response.data
    }

    const setItem = async (_item) => {
        console.log(_item)
        const req = await fetch('/api/v1/items/?' + new URLSearchParams({q: _item}))
        const response = await req.json()
        item.value = response.data[0]
        console.log('Item', item.value)
    }

    const cancelItem = () => {
        item.value = null
        itemSearchTerm.value = ''
        itemsList.value = []
    }

    const serial = ref()
    const serialsList = ref([])
    const serialSearchTerm = ref<string>('')
    const serialSearchMethod = ref<string>('auto')
    const serialCode = ref<string>()
    const serialSku = ref<string>()
    const serialDesignation = ref<string>()
    const serialBrand = ref<string>()
    const fetchSerials = async () => {
        const req = await fetch('/api/v1/serials/?' + new URLSearchParams({q: serialSearchTerm.value}))
        const response = await req.json()
        serialsList.value = response.data
    }

    const setSerial = async (_serial: string, replaceSalesInformation: boolean = false) => {
        const req = await fetch('/api/v1/serials/?' + new URLSearchParams({q: _serial}))
        const response = await req.json()
        serialsList.value = response.data
        serial.value = serialsList.value[0]
        serialCode.value = serial.value.code
        serialSku.value = serial.value.sku
        serialDesignation.value = serial.value.item.itds
        serialBrand.value = serial.value.item.brand.code

        if (!replaceSalesInformation) {
            return;
        }
        order.value = serial.value.order
        invoice.value = serial.value.invoice
        delivery.value = serial.value.delivery
    }

    const setSerialSearchMethod = (_method) => {
        serialSearchMethod.value = _method
    }

    const cancelSerial = () => {
        serial.value = ''
        serialSearchTerm.value = ''
        serialCode.value = ''
        serialSku.value = ''
        serialDesignation.value = ''
        serialBrand.value = ''
        serialsList.value = []
        order.value = ''
        invoice.value = ''
        delivery.value = ''
        serialSearchMethod.value = 'auto'
    }

    const queryingRoutingFromContacts = ref<Boolean>(false)
    const routingFrom = ref()
    const routingFromList = ref<[]>([])
    const routingFromSearchTerm = ref<string>('')
    const routingFromCode = ref()
    const routingFromAddress1 = ref()
    const routingFromAddress2 = ref()
    const routingFromPostcode = ref()
    const routingFromCity = ref()
    const routingFromPhone = ref()
    const routingFromEmail = ref()
    const routingFromInfo = ref()

    const canFetchRoutingFromContacts = computed(() => {
        return routingFromSearchTerm.value.length >= generalMinSearchLength.value
    })

    const fetchRoutingFromContacts = async () => {
        if (canFetchRoutingFromContacts.value) {
            queryingRoutingFromContacts.value = true
            const req = await fetch('/api/v1/contacts/?' + new URLSearchParams({q: routingFromSearchTerm.value}))
            const response = await req.json()
            routingFromList.value = response.data
            queryingRoutingFromContacts.value = false
        } else {
            routingFromList.value = []
        }
    }

    const setRoutingFrom = async (_contact: string) => {
        if (routingFromList.value.length) {
            routingFrom.value = routingFromList.value.find(c => c.code == _contact)
        } else {
            const req = await fetch('/api/v1/contacts/?' + new URLSearchParams({q: _contact}))
            const response = await req.json()
            routingFrom.value = response.data[0]
        }
        routingFromCode.value = routingFrom.value.code
        routingFromAddress1.value = routingFromAddress1.value ?? routingFrom.value.address1
        routingFromAddress2.value = routingFromAddress2.value ?? routingFrom.value.address2
        routingFromPostcode.value = routingFromPostcode.value ?? routingFrom.value.postcode
        routingFromCity.value = routingFromCity.value ?? routingFrom.value.city
        routingFromPhone.value = routingFromPhone.value ?? routingFrom.value.phone
        routingFromEmail.value = routingFromEmail.value ?? routingFrom.value.email
        routingFromInfo.value = routingFromInfo.value ?? routingFrom.value.info
    }

    const cancelRoutingFrom = () => {
        routingFrom.value = null
        routingFromList.value = []
        routingFromSearchTerm.value = ''
        routingFromCode.value = null
        routingFromAddress1.value = null
        routingFromAddress2.value = null
        routingFromPostcode.value = null
        routingFromCity.value = null
        routingFromPhone.value = null
        routingFromEmail.value = null
        routingFromInfo.value = null
    }

    const resetRoutingFromAddress = () => {
        routingFromAddress1.value = routingFrom.value.address1
        routingFromAddress2.value = routingFrom.value.address2
        routingFromPostcode.value = routingFrom.value.postcode
        routingFromCity.value = routingFrom.value.city
        routingFromPhone.value = routingFrom.value.phone
        routingFromEmail.value = routingFrom.value.email
        routingFromInfo.value = routingFrom.value.info
    }

    const queryingRoutingToContacts = ref<Boolean>(false)
    const routingTo = ref()
    const routingToList = ref<[]>([])
    const routingToSearchTerm = ref<string>('')
    const routingToCode = ref()
    const routingToAddress1 = ref()
    const routingToAddress2 = ref()
    const routingToPostcode = ref()
    const routingToCity = ref()
    const routingToPhone = ref()
    const routingToEmail = ref()
    const routingToInfo = ref()

    const canFetchRoutingToContacts = computed(() => {
        return routingToSearchTerm.value.length >= generalMinSearchLength.value
    })

    const fetchRoutingToContacts = async () => {
        if (canFetchRoutingToContacts.value) {
            queryingRoutingToContacts.value = true
            const req = await fetch('/api/v1/contacts/?' + new URLSearchParams({q: routingToSearchTerm.value}))
            const response = await req.json()
            routingToList.value = response.data
            queryingRoutingToContacts.value = false
        } else {
            routingToList.value = []
        }
    }

    const setRoutingTo = async (_contact: string) => {
        if (routingToList.value.length) {
            routingTo.value = routingToList.value.find(c => c.code == _contact)
            console.log(routingTo.value)
        } else {
            const req = await fetch('/api/v1/contacts/?' + new URLSearchParams({q: _contact}))
            const response = await req.json()
            routingTo.value = response.data[0]
        }
        routingToCode.value = routingTo.value.code
        routingToAddress1.value = routingToAddress1.value ?? routingTo.value.address1
        routingToAddress2.value = routingToAddress2.value ?? routingTo.value.address2
        routingToPostcode.value = routingToPostcode.value ?? routingTo.value.postcode
        routingToCity.value = routingToCity.value ?? routingTo.value.city
        routingToPhone.value = routingToPhone.value ?? routingTo.value.phone
        routingToEmail.value = routingToEmail.value ?? routingTo.value.email
        routingToInfo.value = routingToInfo.value ?? routingTo.value.info
    }

    const cancelRoutingTo = () => {
        routingTo.value = null
        routingToList.value = []
        routingToSearchTerm.value = ''
        routingToCode.value = null
        routingToAddress1.value = null
        routingToAddress2.value = null
        routingToPostcode.value = null
        routingToCity.value = null
        routingToPhone.value = null
        routingToEmail.value = null
        routingToInfo.value = null
    }

    const resetRoutingToAddress = () => {
        routingToAddress1.value = routingTo.value.address1
        routingToAddress2.value = routingTo.value.address2
        routingToPostcode.value = routingTo.value.postcode
        routingToCity.value = routingTo.value.city
        routingToPhone.value = routingTo.value.phone
        routingToEmail.value = routingTo.value.email
        routingToInfo.value = routingTo.value.info
    }

    const queryingReturnToContacts = ref<Boolean>(false)
    const returnTo = ref()
    const returnToList = ref<[]>([])
    const returnToSearchTerm = ref<string>('')
    const returnToCode = ref()
    const returnToAddress1 = ref()
    const returnToAddress2 = ref()
    const returnToPostcode = ref()
    const returnToCity = ref()
    const returnToPhone = ref()
    const returnToEmail = ref()
    const returnToInfo = ref()

    const canFetchReturnToContacts = computed(() => {
        return returnToSearchTerm.value.length >= generalMinSearchLength.value
    })

    const fetchReturnToContacts = async () => {
        if (canFetchReturnToContacts.value) {
            queryingReturnToContacts.value = true
            const req = await fetch('/api/v1/contacts/?' + new URLSearchParams({q: returnToSearchTerm.value}))
            const response = await req.json()
            returnToList.value = response.data
            queryingReturnToContacts.value = false
        } else {
            returnToList.value = []
        }
    }

    const setReturnTo = async (_contact) => {
        if (returnToList.value.length) {
            returnTo.value = returnToList.value.find(c => c.code === _contact.code)
        } else {
            const req = await fetch('/api/v1/contacts/?' + new URLSearchParams({q: _contact}))
            const response = await req.json()
            returnTo.value = response.data[0]
        }
        returnToCode.value = returnTo.value.code
        returnToAddress1.value = returnToAddress1.value ?? returnTo.value.address1
        returnToAddress2.value = returnToAddress2.value ?? returnTo.value.address2
        returnToPostcode.value = returnToPostcode.value ?? returnTo.value.postcode
        returnToCity.value = returnToCity.value ?? returnTo.value.city
        returnToPhone.value = returnToPhone.value ?? returnTo.value.phone
        returnToEmail.value = returnToEmail.value ?? returnTo.value.email
        returnToInfo.value = returnToInfo.value ?? returnTo.value.info
    }

    const cancelReturnTo = () => {
        returnTo.value = null
        returnToList.value = []
        returnToSearchTerm.value = ''
        returnToAddress1.value = null
        returnToAddress2.value = null
        returnToPostcode.value = null
        returnToCity.value = null
        returnToPhone.value = null
        returnToEmail.value = null
        returnToEmail.value = null
    }

    const resetReturnToAddress = () => {
        returnToAddress1.value = returnTo.value.address1
        returnToAddress2.value = returnTo.value.address2
        returnToPostcode.value = returnTo.value.postcode
        returnToCity.value = returnTo.value.city
        returnToPhone.value = returnTo.value.phone
        returnToEmail.value = returnTo.value.email
        returnToInfo.value = returnTo.value.info
    }


    /* Section 1 - Qualification */
    const qualificationSectionCompleted = computed(() => {
        return type.value &&
            context.value &&
            reason.value &&
            assignation.value &&
            action.value &&
            destination.value
    })

    /* Section 2 - Ticket associé */
    const ticketSectionCompleted = computed(() => {
        return ticket.value
    })

    /* Section 3 - Produit concerné */
    const productSectionCompleted = computed(() => {
        return item.value
            || serial.value
            || (serialCode.value && serialSku.value && serialDesignation.value && serialBrand.value)
    })

    /* Section 4 - Informations de vente */
    const salesInfoSectionCompleted = computed(() => {
        return true
    })

    /* Section 5 - Cmmentaires */
    const commentsSectionCompleted = computed(() => {
        return info.value &&
            note.value
    })

    /* Section 6 - Acheminement */
    const routingSectionCompleted = computed(() => {
        return routingTo.value &&
            routingFrom.value
    })


    const productReturnIsCompleted = computed(() => {
        return qualificationSectionCompleted.value &&
            ticketSectionCompleted.value &&
            productSectionCompleted.value &&
            salesInfoSectionCompleted.value &&
            commentsSectionCompleted.value &&
            routingSectionCompleted.value
    })

    return {
        generalMinSearchLength,

        status,
        type,
        typesOptions,
        setType,
        context,
        contextsOptions,
        setContext,
        reason,
        reasonsOptions,
        setReason,
        assignation,
        assignationsOptions,
        setAssignation,
        action,
        actionsOptions,
        setAction,
        destination,
        destinationsOptions,
        setDestination,
        ticketSearchTerm,
        fetchTickets,
        ticketsList,
        ticket,
        setTicket,
        cancelTicket,
        item,
        itemsList,
        itemSearchTerm,
        fetchItems,
        setItem,
        cancelItem,
        serial,
        serialsList,
        serialSearchTerm,
        serialSearchMethod,
        serialCode,
        serialSku,
        serialDesignation,
        serialBrand,
        fetchSerials,
        setSerial,
        cancelSerial,
        setSerialSearchMethod,
        bikeSoldAt,
        order,
        invoice,
        delivery,
        info,
        note,

        routingFrom,
        routingFromList,
        routingFromSearchTerm,
        routingFromCode,
        routingFromAddress1,
        routingFromAddress2,
        routingFromPostcode,
        routingFromCity,
        routingFromEmail,
        routingFromPhone,
        routingFromInfo,
        resetRoutingFromAddress,
        fetchRoutingFromContacts,
        setRoutingFrom,
        cancelRoutingFrom,
        canFetchRoutingFromContacts,
        queryingRoutingFromContacts,

        routingTo,
        routingToList,
        routingToSearchTerm,
        routingToCode,
        routingToAddress1,
        routingToAddress2,
        routingToPostcode,
        routingToCity,
        routingToEmail,
        routingToPhone,
        routingToInfo,
        resetRoutingToAddress,
        fetchRoutingToContacts,
        setRoutingTo,
        cancelRoutingTo,
        canFetchRoutingToContacts,
        queryingRoutingToContacts,

        returnTo,
        returnToList,
        returnToSearchTerm,
        returnToCode,
        returnToAddress1,
        returnToAddress2,
        returnToPostcode,
        returnToCity,
        returnToEmail,
        returnToPhone,
        returnToInfo,
        resetReturnToAddress,
        fetchReturnToContacts,
        setReturnTo,
        cancelReturnTo,
        canFetchReturnToContacts,
        queryingReturnToContacts,

        qualificationSectionCompleted,
        ticketSectionCompleted,
        productSectionCompleted,
        salesInfoSectionCompleted,
        commentsSectionCompleted,
        routingSectionCompleted,
        productReturnIsCompleted
    }


})
