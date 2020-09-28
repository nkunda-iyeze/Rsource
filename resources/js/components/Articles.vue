<template>
    <div class="bg-blue-300 p-5">
        <span class="text-2xl flex justify-center items-center font-bold">
            Articles
        </span>
        <div class="flex mx-2 border-b rounded-sm  p-4 ">
            <div :class="[{disable: !pagination.prev_page_ur}]" class="mx-3 " @click="fetchArticles(pagination.prev_page_url)">Previous </div>
            <div class=""> Page {{pagination.current_page}} of {{pagination.last_page}}</div>
            <div :class="[{disable: !pagination.prev_page_ur}]" class="mx-3 " @click="fetchArticles(pagination.next_page_url)">Next</div>
        </div>
        <form-blog/>
    <div class="md:grid grid-cols-3 gap-4">
    <div v-for="article of articles" :key="article.id" class="flex flex-col border rounded-lg shadow-lg m-3 p-5 max-w-sm">
        <span class="font-bold text-2xl"> {{ article.title }} </span>
        <span class="text-sm"> {{ article.body }} </span>

        <div class="flex justify-center items-center m-5 ">
            <button class="bg-red-500 mx-3 px-4 py-3 focus:outline-none  rounded-md " @click="deleteArticle(article.id)">
            Delete Article
        </button>
        <button class="bg-yellow-500 mx-3 px-4 py-3 focus:outline-none rounded-md ">
            Edit Article
        </button>
        </div>

    </div>
    </div>
    </div>
</template>

<script>
import Form from "../components/Form.vue";

export default {
  components: {
    "form-blog": Form
  },

  data() {
    return {
      articles: [],
      article: {
        id: "",
        title: "",
        body: ""
      },
      article_id: "",
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchArticles();
  },
  methods: {
    fetchArticles(page_url) {
      page_url = page_url || "/api/v1/articles";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.articles = res.data;
          this.MakePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    MakePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    },
    deleteArticle(id) {
      if (confirm("are you sure you want to delete ?")) {
        axios
          .delete(`http://resource.test/api/v1/articles/${id}`)
          .then(data => {
            alert("Article Removed !");
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    }
  }
};
</script>

<style lang="sass" scoped>

</style>
