/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_memcpy.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/07 15:35:48 by malallai          #+#    #+#             */
/*   Updated: 2018/11/14 13:00:32 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

void	*ft_memcpy(void *restrict dst, const void *restrict src, size_t n)
{
	char		*tmpdst;
	const char	*tmpsrc;

	tmpdst = dst;
	tmpsrc = src;
	while (n-- > 0)
		*tmpdst++ = *tmpsrc++;
	return (dst);
}
