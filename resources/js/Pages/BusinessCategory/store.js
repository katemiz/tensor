import { writable } from 'svelte/store';


export const treeprops = writable({
  
  titleColumn:"title_en",
  expanded:false,
  title:"Business Category",
  boxTitle:"My Tree",
  home:"My First Node title",
  filter_placeholder:"Search in tree ...",

  commands:{
    add:{
      label:"Add Category"
    }
  }
})

export const formprops = writable({

  header: {
    new: 'Properties',
    update:'Update Properties'
  },

  parent:{
    id:"parentId",
    label:"Parent Business Category",
    placeholder:false
  },

  title_en:{
    id:"titleEN",
    label:"Business Category Definition/Title (EN)",
    placeholder:'Enter business category title/definition'
  },

  title_tr:{
    id:"titleTR",
    label:"İş Kolu İsmi/Tanımı (TR)",
    placeholder:'İş kolu ismini/tanımını giriniz ...'
  },

  editor_en:{
    id:"edEN",
    label:"Business Category Description (EN)",
    placeholder:'Type business category description ...'
  },

  editor_tr:{
    id:"edTR",
    label:"İş Kolu Tanımlaması (TR)",
    placeholder:'İş kolu tanımlamasını giriniz ...'     
  },

  submit :{
    new :{
      label:"Create"
    },

    update:{
      label:"Update"
    }
  }

})


export let iconprops = writable({
    size:'S',
    color:'link'
})

export let tableprops = writable({
  headers:[
    "Id",
    "Title",
    "Remarks",
    "Date",
    "Parent Id"
  ]
})



export const topnode = writable({
  id:0,
  title_en:'Top Business Category',
  title_tr:'Ana İş Kolu',
  level:0,
  children:[]
})



