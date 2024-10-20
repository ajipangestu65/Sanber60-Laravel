<script setup>
import {Head, router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";
import {useToast} from "primevue/usetoast";

const toast = useToast();

const category = ref();
const submitted = ref(false);
const categoryDialog = ref(false);
const deleteCategoryDialog = ref(false);

const props = defineProps({
    categories: {
        type: Object,
        required: true
    }
});

const openNew = (data = {}) => {
    category.value = data;
    submitted.value = false;
    categoryDialog.value = true;
}

const hideDialog = () => {
    categoryDialog.value = false;
    submitted.value = false;
}

const confirmDelete = data => {
    deleteCategoryDialog.value = true;
    category.value = data;
}

const deleteCategory = data => {
    router.delete(route('category.destroy', data.id), {
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Success',
                detail: 'Kategori Berhasil dihapus.',
                life: 3000
            });

            deleteCategoryDialog.value = false;
        }
    });
}

const saveCategory = () => {
    submitted.value = true;

    if (!category.value.name) {
        toast.add({severity: 'error', summary: 'Error', detail: 'Name is required.', life: 3000});
        return;
    }

    if (category.value.id) {
        router.put(route('category.update', category.value.id), category.value, {
            onSuccess: () => {
                toast.add({
                    severity: 'success',
                    summary: 'Success',
                    detail: 'Kategori Berhasil diperbarui.',
                    life: 3000
                });
            }
        });
    } else {
        router.post(route('category.store'), category.value, {
            onSuccess: () => {
                toast.add({
                    severity: 'success',
                    summary: 'Success',
                    detail: 'Kategori Berhasil ditambahkan.',
                    life: 3000
                });
            }
        });
    }

    hideDialog();
}
</script>

<template>
    <Head title="Kelola Kategori"/>
    <Toast/>

    <AuthenticatedLayout>
        <div class="card">
            <Toolbar class="mb-6">
                <template #start>
                    <p>Kelola Kategori</p>
                </template>
                <template #end>
                    <Button label="Tambah" icon="pi pi-plus" severity="secondary" class="mr-2"
                            @click="openNew"/>
                </template>
            </Toolbar>

            <DataTable
                :value="props.categories"
                tableStyle="min-width: 50rem"
                :paginator="true"
                :rows="10"
                paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                :rowsPerPageOptions="[5, 10, 25]"
                currentPageReportTemplate="Showing {first} to {last} of {totalRecords} products"
            >
                <Column field="name" header="Nama Kategori"></Column>
                <Column header="Aksi">
                    <template #body="{ data }">
                        <Button icon="pi pi-pencil" @click="openNew(data)" severity="warning"
                                rounded></Button>
                        <Button icon="pi pi-trash" @click="confirmDelete(data)" severity="danger"
                                rounded></Button>
                    </template>
                </Column>
            </DataTable>
        </div>

        <Dialog v-model:visible="categoryDialog" :style="{ width: '450px' }" header="Detil Kategori"
                :modal="true">
            <div class="flex flex-col gap-6">
                <div>
                    <label for="name" class="block font-bold mb-3">Nama Kategori</label>
                    <InputText id="name" v-model.trim="category.name" required="true" autofocus
                               :invalid="submitted && !category.name" fluid/>
                    <small v-if="submitted && !category.name" class="text-red-500">Name is
                        required.</small>
                </div>
            </div>

            <template #footer>
                <Button label="Batal" icon="pi pi-times" text @click="hideDialog"/>
                <Button label="Simpan" icon="pi pi-check" @click="saveCategory"/>
            </template>
        </Dialog>

        <Dialog v-model:visible="deleteCategoryDialog" :style="{ width: '450px' }"
                header="Konfirmasi Hapus"
                :modal="true">
            <div class="flex items-center gap-4">
                <i class="pi pi-exclamation-triangle !text-3xl"/>
                <span v-if="category">
                    Apakah kamu yakin ingin menghapus kategori <b>{{ category.name }}</b>?
                </span>
            </div>
            <template #footer>
                <Button label="Tidak" icon="pi pi-times" text
                        @click="deleteCategoryDialog = false"/>
                <Button label="Ya, Hapus" severity="danger" icon="pi pi-check"
                        @click="deleteCategory(category)"/>
            </template>
        </Dialog>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">

</style>
