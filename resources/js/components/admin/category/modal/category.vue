<template>
  <modal
    ref="childmodal"
    name="catlisher_detail"
    :scrollable="true"
    :height="'auto'"
    :width="'80%'"
    :style="'z-index:1000'"
    @closed="hideModal()"
  >
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div
              class="
                iq-card-header
                d-flex
                justify-content-between
                align-items-center
              "
            >
              <h4 class="card-title mb-0">Category Information Preview</h4>
            </div>
            <div class="iq-card-body pb-0">
              <div class="description-contens align-items-top row">
                <div class="col-md-12">
                  <div class="row align-items-center">
                    <div class="col">
                      <div
                        class="
                          iq-card-transparent
                          iq-card-block
                          iq-card-stretch
                          iq-card-height
                        "
                      >
                        <div class="iq-card-body p-0">
                          <p>
                            <span
                              >Last Modified by:
                              <b
                                >{{
                                  data.modified_by == null
                                    ? data.created_by
                                    : data.modified_by
                                }}
                                ,
                              </b></span
                            >
                            <span>
                              <b>
                                {{
                                  moment(data.modified_at).format(
                                    "YYYY/MM/DD H:mm:ss a"
                                  )
                                }}</b
                              ></span
                            >
                          </p>
                          <p
                            v-if="data.deleted_at != null"
                            class="iq-card-body p-1 text-danger"
                          >
                            <span
                              >Deleted by: <b>{{ data.deleted_by }}</b></span
                            >,
                            <span
                              >At :
                              <b>{{
                                moment(data.deleted_at).format(
                                  "YYYY/MM/DD H:mm:ss a"
                                )
                              }}</b></span
                            >
                          </p>
                          <h3 class="mb-3">
                            {{ data.name }}
                          </h3>
                          <span
                            class="text-dark mb-4 pb-4 iq-border-bottom d-block"
                            v-html="data.description"
                          ></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <b-tabs>
                    <!-- General -->
                    <b-tab no-body title="General">
                      <div
                        class="
                          iq-card iq-card-block iq-card-stretch iq-card-height
                        "
                      >
                        <div
                          class="
                            iq-card-header
                            d-flex
                            justify-content-between
                            align-items-center
                            position-relative
                          "
                        ></div>
                        <div class="iq-header-title">
                          <h3 class="card-title mb-0">
                            The Books Belong To The Category: "{{ data.name }}"
                          </h3>
                        </div>
                        <b-overlay :show="check" rounded="sm">
                          <div class="iq-card-body">
                            <div class="row" v-if="data.books.length > 0">
                              <div
                                v-for="item in data.books"
                                :key="item.book_id"
                                class="col-sm-6 col-md-4 col-lg-3"
                              >
                                <div
                                  class="
                                    iq-card
                                    iq-card-block
                                    iq-card-stretch
                                    iq-card-height
                                    browse-bookcontent
                                  "
                                >
                                  <div class="iq-card-body p-0">
                                    <div class="d-flex align-items-center">
                                      <div
                                        class="
                                          col-6
                                          p-0
                                          position-relative
                                          image-overlap-shadow
                                        "
                                      >
                                        <a href="javascript:void();"
                                          ><img
                                            v-if="item.img != null"
                                            class="img-fluid rounded w-100"
                                            :src="'/' + item.img"
                                            alt=""
                                          /><img
                                            v-else
                                            class="img-fluid rounded w-100"
                                            src="/images/books/default.jpg"
                                            alt=""
                                          />
                                        </a>
                                        <div class="view-book">
                                          <a
                                            href="#"
                                            @click="showModal(item)"
                                            class="btn btn-sm btn-white"
                                            >View Book</a
                                          >
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="mb-2">
                                          <h5 class="mb-1">
                                            {{
                                              $root.truncate(
                                                item.book_name,
                                                50,
                                                "..."
                                              )
                                            }}
                                          </h5>
                                          <div class="d-block line-height">
                                            <span
                                              class="font-size-11 text-primary"
                                              v-for="author in item.author"
                                              :key="author.id"
                                            >
                                              {{ author.name + " " }}
                                            </span>
                                          </div>
                                        </div>
                                        <div
                                          v-if="item.promotion_price != null"
                                          class="
                                            price
                                            d-flex
                                            align-items-center
                                          "
                                        >
                                          <span class="pr-1 old-price">{{
                                            item.price
                                              | currency("đ", 0, {
                                                symbolOnLeft: false,
                                                spaceBetweenAmountAndSymbol: true,
                                              })
                                          }}</span>
                                          <h6>
                                            <b>{{
                                              item.promotion_price
                                                | currency("đ", 0, {
                                                  symbolOnLeft: false,
                                                  spaceBetweenAmountAndSymbol: true,
                                                })
                                            }}</b>
                                          </h6>
                                        </div>
                                        <div
                                          v-else
                                          class="price align-items-center"
                                        >
                                          <h6>
                                            <span>
                                              <b>{{
                                                item.price
                                                  | currency("đ", 0, {
                                                    symbolOnLeft: false,
                                                    spaceBetweenAmountAndSymbol: true,
                                                  })
                                              }}</b>
                                            </span>
                                          </h6>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div v-else>
                              <p>
                                Oops! There are no books in {{ data.name }} !!
                              </p>
                            </div>
                          </div>
                        </b-overlay>
                      </div>
                    </b-tab>
                    <!-- Optinal children category -->
                    <b-tab
                      v-for="child in data.descendants"
                      :key="child.id"
                      :title="child.name"
                      @click="load(child)"
                    >
                      <div
                        class="
                          iq-card iq-card-block iq-card-stretch iq-card-height
                        "
                      >
                        <div
                          class="
                            iq-card-header
                            d-flex
                            justify-content-between
                            align-items-center
                            position-relative
                          "
                        ></div>
                        <div class="iq-header-title">
                          <h3 class="card-title mb-0">
                            The Books Belong To The Category: "{{ child.name }}"
                          </h3>
                        </div>
                        <b-overlay :show="check" rounded="sm">
                          <div class="iq-card-body">
                            <div class="row" v-if="child.books.length > 0">
                              <div
                                v-for="item in child.books"
                                :key="item.book_id"
                                class="col-sm-6 col-md-4 col-lg-3"
                              >
                                <div
                                  class="
                                    iq-card
                                    iq-card-block
                                    iq-card-stretch
                                    iq-card-height
                                    browse-bookcontent
                                  "
                                >
                                  <div class="iq-card-body p-0">
                                    <div class="d-flex align-items-center">
                                      <div
                                        class="
                                          col-6
                                          p-0
                                          position-relative
                                          image-overlap-shadow
                                        "
                                      >
                                        <a href="javascript:void();"
                                          ><img
                                            v-if="item.img != null"
                                            class="img-fluid rounded w-100"
                                            :src="'/' + item.img"
                                            alt=""
                                          /><img
                                            v-else
                                            class="img-fluid rounded w-100"
                                            src="/images/books/default.jpg"
                                            alt=""
                                          />
                                        </a>
                                        <div class="view-book">
                                          <a
                                            href="#"
                                            @click="showModal(item)"
                                            class="btn btn-sm btn-white"
                                            >View Book</a
                                          >
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="mb-2">
                                          <h5 class="mb-1">
                                            {{
                                              $root.truncate(
                                                item.book_name,
                                                50,
                                                "..."
                                              )
                                            }}
                                          </h5>
                                          <div class="d-block line-height">
                                            <span
                                              class="font-size-11 text-primary"
                                              v-for="author in item.author"
                                              :key="author.id"
                                            >
                                              {{ author.name + " " }}
                                            </span>
                                          </div>
                                        </div>
                                        <div
                                          v-if="item.promotion_price != null"
                                          class="
                                            price
                                            d-flex
                                            align-items-center
                                          "
                                        >
                                          <span class="pr-1 old-price">{{
                                            item.price
                                              | currency("đ", 0, {
                                                symbolOnLeft: false,
                                                spaceBetweenAmountAndSymbol: true,
                                              })
                                          }}</span>
                                          <h6>
                                            <b>{{
                                              item.promotion_price
                                                | currency("đ", 0, {
                                                  symbolOnLeft: false,
                                                  spaceBetweenAmountAndSymbol: true,
                                                })
                                            }}</b>
                                          </h6>
                                        </div>
                                        <div
                                          v-else
                                          class="price align-items-center"
                                        >
                                          <h6>
                                            <span>
                                              <b>{{
                                                item.price
                                                  | currency("đ", 0, {
                                                    symbolOnLeft: false,
                                                    spaceBetweenAmountAndSymbol: true,
                                                  })
                                              }}</b>
                                            </span>
                                          </h6>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div v-else>
                              <p>
                                Oops! There are no books in {{ data.name }} !!
                              </p>
                            </div>
                          </div>
                        </b-overlay>
                      </div>
                    </b-tab>
                  </b-tabs>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <book
        v-if="book != null"
        name="books"
        :detail="book"
        ref="reference"
      ></book>
    </div>
  </modal>
</template>
<script>
import moment from "moment";
import book from "../../book/modal/book_detail.vue";
import { values } from "lodash";
export default {
  components: { book },
  props: ["detail"],
  data() {
    return {
      data: this.detail,
      check: true,
      list: [],
      mess: "",
      book: [],
    };
  },
  methods: {
    show_model: function (item) {
      this.$modal.show("catlisher_detail");
      // Khong su dung api call nen khong can xai
      //this.loading_books(item.id);
      this.check = false;
      return (this.data = item);
    },
    moment: function () {
      return moment();
    },
    loading_books(id) {
      this.get_list_books(id);
      setTimeout(() => {
        this.check = false;
      }, 1000);
    },
    hideModal() {
      return (this.data = this.detail), (this.show = true), (this.mess = "");
    },
    get_list_books(id) {
      console.log("Loading ......");
      axios
        .get("../admin/category/" + id)
        .then((response) => {
          this.list = response.data;
          console.log("Done");
        })
        .catch((err) => {
          this.mess = "NOT FOUND";
          this.list = [];
        });
    },
    load(item) {
      let result = [];
      this.$parent.category.forEach((cat) => {
        if (cat.name === item.name) {
          return (result = cat);
        }
      });
    },
    showModal(item) {
      this.book = item;
      this.$refs.reference.show_model(item);
    },
  },

  beforeUpdate() {
    this.data.descendants.forEach((element) => {
      if (element.books.length > 0) {
        element.books.forEach((book) => {
          if (this.data.books.includes(book) == false) {
            this.data.books.push(book);
          }
        });
      }
    });
  },
};
</script>

<style scoped>
</style>