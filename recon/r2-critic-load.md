---
title: "R2 Critic: Queue Architecture Stress Test"
date: 2026-08-13
agent: critic
round: 2
---

## Scenario 1: High Article Volume

**Assume:** 100 articles published daily, 30% without images (30 articles).

**Queue load:**
- 30 jobs/day = 1.25 jobs/hour (average)
- Peak: 10 jobs in 1 hour (morning editorial rush)
- FLUX.2-dev: 30 seconds/job = 5 minutes for peak
- FLUX.2-klein: 10 seconds/job = 1.7 minutes for peak

**Assessment:** Manageable with single queue worker. No special scaling needed.

## Scenario 2: Breaking News Event

**Assume:** Major event, 50 articles in 2 hours, all without images.

**Queue load:**
- 50 jobs in 2 hours = 25 jobs/hour
- FLUX.2-dev: 30 seconds/job = 12.5 minutes queue time
- FLUX.2-klein: 10 seconds/job = 4.2 minutes queue time

**Assessment:** 
- FLUX.2-dev: 12.5 minutes delay for last article (acceptable)
- FLUX.2-klein: 4.2 minutes delay (excellent)
- Need to ensure queue worker doesn't crash under load

## Scenario 3: Queue Worker Failure

**Assume:** Queue worker crashes mid-job.

**Current behavior:**
- Job marked as failed
- Article remains without image
- No automatic retry

**Required improvements:**
1. Automatic retry (3 attempts)
2. Failed job notification
3. Manual retry command
4. Dead letter queue for permanently failed jobs

## Scenario 4: Unsloth API Downtime

**Assume:** Unsloth service crashes or becomes unresponsive.

**Current behavior:**
- HTTP request times out
- Job fails
- No fallback

**Required improvements:**
1. Health check before processing
2. Timeout with retry
3. Circuit breaker pattern
4. Placeholder image fallback

## Scenario 5: Concurrent Requests

**Assume:** Multiple queue workers processing simultaneously.

**Current behavior:**
- Race conditions on article update
- Duplicate image generation
- Storage conflicts

**Required improvements:**
1. Lock mechanism (database lock or Redis)
2. Idempotent jobs (check if image exists before generating)
3. Unique constraint on article_id + generation_id

## Scenario 6: Large Image Storage

**Assume:** 1000 articles with AI images, 1MB each = 1GB storage.

**Assessment:**
- Storage is manageable
- Need cleanup strategy for old images
- Consider CDN for delivery
- Backup strategy required

## Scenario 7: Memory Leaks

**Assume:** FLUX2 model stays loaded in memory indefinitely.

**Current behavior:**
- Memory usage grows over time
- Eventually OOM kill

**Required improvements:**
1. Model unloading after N jobs
2. Memory monitoring
3. Automatic restart on high memory
4. Resource limits (Docker/cgroup)

## Scenario 8: Prompt Injection

**Assume:** Malicious prompt in article content.

**Current behavior:**
- Prompt sent directly to FLUX2
- Potential for inappropriate content

**Required improvements:**
1. Prompt sanitization
2. Content filtering
3. Editorial review (already recommended)
4. Rate limiting

## Recommendations

1. **Implement retry logic** — 3 attempts with exponential backoff
2. **Add health checks** — Verify Unsloth before processing
3. **Use locking** — Prevent concurrent processing of same article
4. **Monitor resources** — Memory, CPU, queue depth
5. **Implement circuit breaker** — Stop processing if Unsloth is down
6. **Add dead letter queue** — For permanently failed jobs
7. **Rate limiting** — Prevent prompt abuse
8. **Logging** — Track all generation attempts

## Architecture Improvements

```
Controller → Create Job → Queue → Worker → Health Check → Generate → Store → Notify
                                        ↓
                              Retry Logic (3x)
                                        ↓
                              Dead Letter Queue
```

**Key insight:** The queue architecture needs to be resilient, not just functional. Production systems fail — the question is how gracefully they fail.
