<template>
	<breeze-authenticated-layout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Files
			</h2>
		</template>

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 bg-white border-b border-gray-200">
						<div class="flex flex-col">
							<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
								<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
									<div class="font-bold text-xl mb-4">{{ editMode ? 'Edit File' : 'Create New File' }}</div>

									<breeze-validation-errors class="mb-4" />

									<form @submit.prevent="submit">
										<div class="mb-4">
											<breeze-label
												for="name"
												value="Name"
											/>
											<breeze-input
												id="name"
												type="text"
												class="mt-1 block w-full"
												v-model="form.name"
												required
												autofocus
												autocomplete="name"
											/>
										</div>

										<div class="grid grid-cols-2 gap-4">
											<div>
												<label class="block font-medium font-bold text-sm text-gray-700 mb-1">File Attributes</label>
												<draggable
													class="list-group"
													:list="form.attributes"
													group="people"
													@change="log"
													itemKey="name"
												>
													<template #item="{ element, index }">
														<div class="border list-none rounded-sm px-3 py-3 list-group-item">{{ element.name }}</div>
													</template>
												</draggable>
											</div>

											<div>
												<label class="block font-medium font-bold text-sm text-gray-700 mb-1">Attributes</label>
												<draggable
													class="list-group"
													:list="attributes"
													group="people"
													@change="log"
													itemKey="name"
												>
													<template #item="{ element, index }">
														<div class="border list-none rounded-sm px-3 py-3 list-group-item">{{ element.name }}</div>
													</template>
												</draggable>
											</div>
										</div>

										<div class="flex items-center justify-end mt-4">
											<inertia-link
												:href="route('files')"
												class="underline text-sm text-gray-600 hover:text-gray-900"
											>
												Cancel
											</inertia-link>

											<breeze-button
												class="ml-4"
												:class="{ 'opacity-25': form.processing }"
												:disabled="form.processing"
											>
												{{ editMode ? 'Update' : 'Save' }}
											</breeze-button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import Pagination from "@/Components/Pagination";
import ButtonLink from "@/Components/ButtonLink";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeButton from "@/Components/Button";
import BreezeValidationErrors from "@/Components/ValidationErrors";
import draggable from "vuedraggable";

export default {
	components: {
		BreezeAuthenticatedLayout,
		Pagination,
		ButtonLink,
		BreezeInput,
		BreezeLabel,
		BreezeButton,
		BreezeValidationErrors,
		draggable,
	},

	data() {
		return {
			form: this.$inertia.form({
				name: "",
				attributes: [],
			}),
			editMode: false,
			id: null,
		};
	},

	computed: {
		attributes() {
			return this.$page.props.attributes;
		},
	},

	created() {
		if (this.$page.props.data) {
			const { data } = this.$page.props;
			this.form.name = data.name;
			this.form.attributes = data.attributes;

			if (data.id) {
				this.editMode = true;
				this.id = data.id;
			}
		}
	},

	methods: {
		submit() {
			if (this.id) {
				this.form.put(this.route("files.edit", this.id), {
					onFinish: () => this.form.reset("name"),
				});
			} else {
				this.form.post(this.route("files.create"), {
					onFinish: () => this.form.reset("name"),
				});
			}
		},
	},
};
</script>

<style scoped>
.list-group {
	min-height: 200px;
	background-color: #f9f9f9;
}
.list-group-item {
	background-color: #dddddd;
}
.list-group-item:not(:last-child) {
	border-bottom: none;
}
</style>
