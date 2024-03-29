/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strncat.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/10 14:08:01 by malallai          #+#    #+#             */
/*   Updated: 2018/11/14 14:05:07 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strncat(char *restrict dst, const char *restrict src, size_t n)
{
	int i;

	i = ft_strlen(dst);
	while (*src && n-- > 0)
		dst[i++] = *src++;
	dst[i] = 0;
	return (dst);
}
