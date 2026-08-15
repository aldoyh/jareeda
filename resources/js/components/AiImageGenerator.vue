<template>
    <div class="ai-image-generator">
        <div class="mb-3">
            <label class="form-label">{{ t('AI Image Generation') }}</label>
            <div class="d-flex gap-2 align-items-start">
                <div class="flex-grow-1">
                    <textarea
                        v-model="prompt"
                        class="form-control"
                        :placeholder="t('Enter prompt for image generation...')"
                        rows="3"
                        :disabled="generating"
                    ></textarea>
                    <small class="text-muted">
                        {{ t('Leave empty to auto-generate from article title and content') }}
                    </small>
                </div>
                <div class="d-flex flex-column gap-2">
                    <button
                        type="button"
                        class="btn btn-primary"
                        :disabled="generating || !canGenerate"
                        @click="generateImage"
                    >
                        <span v-if="generating" class="spinner-border spinner-border-sm me-1"></span>
                        <span v-else class="me-1">✦</span>
                        {{ generating ? t('Generating...') : t('Generate') }}
                    </button>
                    <button
                        v-if="currentImage"
                        type="button"
                        class="btn btn-outline-secondary btn-sm"
                        @click="clearImage"
                    >
                        {{ t('Clear') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Current Image Preview -->
        <div v-if="currentImage" class="mt-3">
            <label class="form-label">{{ t('Generated Image') }}</label>
            <div class="position-relative">
                <img
                    :src="currentImage"
                    :alt="t('AI Generated Image')"
                    class="img-fluid rounded"
                    style="max-height: 300px;"
                >
                <span v-if="isAiGenerated" class="badge bg-info position-absolute top-0 end-0 m-2">
                    {{ t('AI Generated') }}
                </span>
            </div>
            <div v-if="generatedAt" class="mt-2">
                <small class="text-muted">
                    {{ t('Generated') }}: {{ formatDate(generatedAt) }}
                </small>
            </div>
        </div>

        <!-- Error Message -->
        <div v-if="error" class="alert alert-danger mt-3">
            {{ error }}
        </div>

        <!-- Generation Status -->
        <div v-if="generating" class="mt-3">
            <div class="progress" style="height: 20px;">
                <div
                    class="progress-bar progress-bar-striped progress-bar-animated"
                    role="progressbar"
                    style="width: 100%"
                ></div>
            </div>
            <small class="text-muted mt-1 d-block">
                {{ t('This may take 10-30 seconds...') }}
            </small>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const props = defineProps({
    articleId: {
        type: [Number, String],
        required: true,
    },
    existingImage: {
        type: String,
        default: null,
    },
    isAiGenerated: {
        type: Boolean,
        default: false,
    },
    generatedAt: {
        type: String,
        default: null,
    },
});

const emit = defineEmits(['update:image', 'update:aiGenerated']);

const prompt = ref('');
const currentImage = ref(props.existingImage);
const generating = ref(false);
const error = ref(null);

const canGenerate = computed(() => {
    return !generating.value;
});

const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString(undefined, {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};

const generateImage = async () => {
    if (generating.value) return;

    generating.value = true;
    error.value = null;

    try {
        const response = await fetch(`/admin/news/${props.articleId}/generate-image`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
            },
            body: JSON.stringify({
                prompt: prompt.value || null,
            }),
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Failed to generate image');
        }

        currentImage.value = data.image_path;
        emit('update:image', data.image_path);
        emit('update:aiGenerated', true);

    } catch (err) {
        error.value = err.message;
        console.error('Image generation failed:', err);
    } finally {
        generating.value = false;
    }
};

const clearImage = () => {
    currentImage.value = null;
    prompt.value = '';
    emit('update:image', null);
    emit('update:aiGenerated', false);
};

onMounted(() => {
    if (props.existingImage) {
        currentImage.value = props.existingImage;
    }
});
</script>

<style scoped>
.ai-image-generator {
    border: 1px solid var(--bs-gray-200);
    border-radius: var(--bs-border-radius);
    padding: 1rem;
    background-color: var(--bs-gray-50);
}
</style>
