---
title: "R2 Explorer: Unsloth Deployment Deep Dive"
date: 2026-08-13
agent: explorer
round: 2
---

## Unsloth Deployment Options

### Option 1: Same Server as Laravel

**Setup:** Run Unsloth on the same server as the Laravel application.

**Requirements:**
- GPU with 8GB+ VRAM (for FLUX.2-klein)
- GPU with 12GB+ VRAM (for FLUX.2-dev)
- Python 3.10+ with Unsloth installed
- Port 8888 exposed for API access

**Pros:**
- Simple networking (localhost communication)
- No additional infrastructure
- Easy debugging

**Cons:**
- Shares resources with Laravel (CPU, RAM)
- GPU may be needed for other tasks
- Single point of failure

**Recommendation:** Good for development and small deployments.

### Option 2: Separate GPU Server

**Setup:** Dedicated server for Unsloth, Laravel connects via network.

**Requirements:**
- Dedicated GPU server (cloud or on-premises)
- Network configuration for API access
- Load balancing if multiple instances

**Pros:**
- Dedicated resources for AI generation
- Scalable (add more GPU servers)
- Isolated failure domain

**Cons:**
- Additional infrastructure cost
- Network latency
- More complex deployment

**Recommendation:** Best for production with significant image generation needs.

### Option 3: Docker Container

**Setup:** Unsloth in Docker, orchestrated with Laravel.

**Requirements:**
- Docker with NVIDIA runtime (for GPU access)
- docker-compose.yml with Unsloth service
- Volume mounts for model storage

**Pros:**
- Consistent environment
- Easy scaling
- Isolated dependencies

**Cons:**
- GPU passthrough complexity
- Larger deployment size
- Docker overhead

**Recommendation:** Good for consistent deployments across environments.

### Option 4: Cloud GPU Service

**Setup:** Use RunPod, Vast.ai, or similar for burst capacity.

**Requirements:**
- Cloud GPU account
- API integration
- Cost management

**Pros:**
- No hardware investment
- Scale on demand
- Latest GPUs available

**Cons:**
- Ongoing cost
- Network latency
- Data privacy concerns

**Recommendation:** Good for burst capacity or testing.

## VRAM Requirements by Model

| Model | VRAM | Speed | Quality | Use Case |
|-------|------|-------|---------|----------|
| FLUX.2-klein-4B | 4GB | Fast | Good | Development, previews |
| FLUX.2-klein-9B | 8GB | Medium | Better | Small production |
| FLUX.2-dev | 12GB+ | Slow | Best | Production, quality |
| FLUX.2-dev + LoRA | 16GB+ | Slowest | Excellent | Custom styles |

## Recommended Setup for Jareeda

**Development:**
- FLUX.2-klein-4B on developer machine
- Localhost API at localhost:8888
- Queue jobs for background generation

**Production:**
- FLUX.2-dev on dedicated GPU server
- Docker container for consistency
- Queue workers for processing
- Placeholder images while generating

**Cost Estimate:**
- Development: Free (local hardware)
- Production: $200-500/month (cloud GPU)
- Burst capacity: $0.50-2.00/hour (RunPod)

## Integration Architecture

```
Laravel App → Queue Job → Unsloth API → Generated Image → Storage
                ↓
        Editorial Review → Publish
```

**Key Components:**
1. `UnslothImageService` — HTTP client for API calls
2. `GenerateArticleImage` — Queue job for background processing
3. `ArticleImageGenerated` — Event for notification
4. `GenerateArticleImages` — Artisan command for bulk operations

## Performance Optimization

1. **Model pre-loading:** Keep FLUX2 model loaded in memory
2. **Batch processing:** Queue multiple images, process sequentially
3. **Caching:** Store generated images, avoid regeneration
4. **Async UI:** Show placeholders, update via WebSocket

## Recommendations

1. **Start with FLUX.2-klein-4B** for development
2. **Use Docker** for consistent deployment
3. **Queue all generations** (never synchronous)
4. **Monitor VRAM usage** to avoid OOM errors
5. **Implement health checks** for Unsloth service
